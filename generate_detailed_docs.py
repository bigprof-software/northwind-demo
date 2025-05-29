import json
import re
import sys

def parse_php_doc_comment(comment_str):
    """Parses a PHP doc comment string to extract description, params, and return info."""
    description_lines = []
    params = {}
    return_info = {"type": "mixed", "description": ""}
    in_description = True

    for line in comment_str.splitlines():
        line = line.strip()
        # Remove common comment prefixes like *, /*, */
        if line.startswith("/**"): line = line[3:]
        if line.startswith("*"): line = line[1:].strip()
        if line.endswith("*/"): line = line[:-2].strip()
        line = line.strip()

        if line.startswith("@param"):
            in_description = False
            parts = re.match(r"@param\s+([^\s]+)\s+\$([^\s]+)\s*(.*)", line)
            if parts:
                ptype, pname, pdesc = parts.groups()
                params[pname] = {"type": ptype, "description": pdesc.strip(), "name": pname, "example": get_example_value(ptype)}
        elif line.startswith("@return"):
            in_description = False
            parts = re.match(r"@return\s+([^\s]+)\s*(.*)", line)
            if parts:
                rtype, rdesc = parts.groups()
                return_info = {"type": rtype, "description": rdesc.strip()}
        elif line.startswith("@brief"):
            in_description = True # Continue description after @brief
            description_lines.append(line.replace("@brief", "").strip())
        elif line.startswith("@see"):
            in_description = False # @see is usually at the end
            # For now, we are not parsing @see from here, but from code later
            pass
        elif line.startswith("@deprecated") or line.startswith("@note") or line.startswith("@since"):
            in_description = False # Stop main description for these tags
            # Could add these as separate fields if needed
        elif in_description and line and not line.startswith("@"):
            description_lines.append(line)
        elif not line and in_description and description_lines: # Keep paragraphs
            description_lines.append("")


    full_description = "\n".join(description_lines).strip()
    # Clean up excessive newlines that might result from paragraph spacing
    full_description = re.sub(r'\n\n+', '\n\n', full_description)
    return full_description, params, return_info

def get_example_value(var_type):
    """Provides a generic example value based on type."""
    var_type_lower = var_type.lower()
    if "string" in var_type_lower: return "''"
    if "int" in var_type_lower: return "0"
    if "array" in var_type_lower: return "[]"
    if "bool" in var_type_lower: return "false"
    if "object" in var_type_lower: return "new stdClass()"
    if "callable" in var_type_lower: return "function() {}"
    return "null"

def extract_function_signature_params(php_code_lines, function_data):
    """Extracts parameters from the function signature in the PHP code."""
    # Get the line with the function definition
    # function_data['start_line'] is 1-indexed
    try:
        # The function signature is on function_data['start_line'] -1
        # but the actual parameters are within the parentheses
        signature_line_content = ""
        # The signature might span multiple lines, so we need to reconstruct it
        # from function_data['start_line'] up to the first '{'
        for i in range(function_data['start_line'] - 1, function_data['end_line']):
            line = php_code_lines[i]
            signature_line_content += line
            if '{' in line:
                break
        
        # Extract content within parentheses: function name(...) {
        match = re.search(r"function\s+&?%s\s*\((.*?)\)\s*\{" % re.escape(function_data['name']), signature_line_content, re.DOTALL)
        if not match:
            return {} # Could not parse signature
    except IndexError:
        return {} # Line numbers out of bounds

    params_str = match.group(1).strip()
    if not params_str:
        return {}

    params_details = {}
    # Regex to split params, considering type hints, defaults, and by-reference
    # Covers: type $param, $param, type &$param, $param = default, type $param = default, etc.
    param_regex = re.compile(
        r"(?:([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\\]*)\s+)?(&?\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*(?:=\s*([^,]+))?"
    )
    
    raw_params = params_str.split(',')
    for p_match_str in raw_params:
        p_match_str = p_match_str.strip()
        p_match = param_regex.match(p_match_str)
        if p_match:
            hint_type, var_name_ref, default_val = p_match.groups()
            var_name = var_name_ref.replace('&','').replace('$','')
            
            param_info = {"name": var_name, "type": hint_type if hint_type else "mixed", "description": "", "example": ""}
            if default_val:
                param_info["example"] = default_val.strip()
                param_info["description"] = f"Optional. Default: {default_val.strip()}."
            else:
                 param_info["example"] = get_example_value(param_info["type"])
            
            params_details[var_name] = param_info
    return params_details


def analyze_function(function_data, php_code_lines, all_function_names):
    """Analyzes a single function's comment and code."""
    name = function_data['name']
    comment = function_data['comment']
    start_line = function_data['start_line']
    end_line = function_data['end_line']

    # Extract code block for the function (0-indexed)
    function_code_block = "\n".join(php_code_lines[start_line-1:end_line])

    # 1. Description, Params from Doc Comment, Return from Doc Comment
    doc_description, doc_params, doc_return = parse_php_doc_comment(comment)
    
    # 2. Parameters from function signature (to get names and possibly types/defaults)
    sig_params = extract_function_signature_params(php_code_lines, function_data)

    # Merge parameter info: signature params are primary, doc_params add description/type
    merged_params = []
    for pname, pinfo_sig in sig_params.items():
        pmerged = pinfo_sig.copy()
        if pname in doc_params:
            if doc_params[pname]['type'] != 'mixed' and pmerged['type'] == 'mixed': # Prefer docblock type if specific
                 pmerged['type'] = doc_params[pname]['type']
            if doc_params[pname]['description']:
                 pmerged['description'] = doc_params[pname]['description'] + (" " + pmerged['description'] if pmerged['description'] and not pmerged['description'].startswith("Optional.") else "")
            if not pmerged['example'] or pmerged['example'] == 'null': # prefer docblock example if signature one is generic
                 pmerged['example'] = doc_params[pname].get('example', get_example_value(pmerged['type']))
        merged_params.append(pmerged)

    # 3. Description refinement
    description = doc_description
    if not description.strip() or description.startswith("###"): # If comment is just '#####' or empty
        # Basic heuristic: describe based on first few non-trivial lines of code
        first_lines_summary = []
        for line_idx in range(start_line, min(start_line + 5, end_line)): # Look at first 5 lines within function
            code_line = php_code_lines[line_idx].strip()
            if code_line and not code_line.startswith("{") and not code_line.startswith("}"):
                first_lines_summary.append(code_line)
            if len(first_lines_summary) >=2:
                break
        if first_lines_summary:
            description = "Function starts with: " + " ; ".join(first_lines_summary)
        else:
            description = "No detailed description available in comments."
    
    # 4. Return Value refinement
    return_value = doc_return
    if not return_value['description'] and return_value['type'] == 'mixed': # If doc_return is generic
        # Check for `return` statements in the code
        return_statements = re.findall(r"return\s+(.*?);", function_code_block)
        if not return_statements:
            return_value['type'] = "void"
            return_value['description'] = "This function does not return a value."
        elif len(return_statements) == 1:
            # Very basic inference from the returned value
            ret_val_str = return_statements[0].strip()
            if ret_val_str.startswith("$") or "new" in ret_val_str or "()" in ret_val_str : # Variable, object, or function call
                return_value['description'] = f"Returns the result of: {ret_val_str}"
            else: # Literal
                return_value['description'] = f"Returns a literal value: {ret_val_str}"
            if 'false' in ret_val_str.lower() or 'true' in ret_val_str.lower():
                 return_value['type'] = "bool"
            elif ret_val_str.startswith("'") or ret_val_str.startswith('"'):
                 return_value['type'] = "string"
            elif ret_val_str.isdigit():
                 return_value['type'] = "int"
        else:
            return_value['description'] = "Returns different values based on conditions."
            return_value['type'] = "mixed" # Multiple return points, likely mixed

    # 5. How it Works (very basic)
    how_it_works = "Details about internal logic are inferred from the code."
    if "sql(" in function_code_block or "sqlValue(" in function_code_block:
        how_it_works += " Involves database operations."
    if "foreach(" in function_code_block or "for(" in function_code_block or "while(" in function_code_block:
        how_it_works += " Contains loop(s) for iteration."
    if "if(" in function_code_block:
        how_it_works += " Uses conditional logic."
    if len(function_code_block.splitlines()) < 10:
         how_it_works = "A relatively short function. " + how_it_works

    # 6. Examples of Usage
    example_usage_str = ""
    param_examples_for_call = []
    for p in merged_params:
        param_examples_for_call.append(p['example'] if p['example'] else get_example_value(p['type']))
    example_usage_str = f"{name}({', '.join(param_examples_for_call)});"
    # if doc_params has @example tags, try to use that
    # (current parse_php_doc_comment doesn't extract @example, this is a placeholder for future improvement)

    # 7. See Also
    see_also = []
    for other_func_name in all_function_names:
        if other_func_name != name:
            # Simple check if another function name is called
            if re.search(r"\b" + re.escape(other_func_name) + r"\s*\(", function_code_block):
                see_also.append(other_func_name)
    
    return {
        "function_name": name,
        "description": description.strip(),
        "parameters": merged_params,
        "return_value": return_value,
        "how_it_works": how_it_works.strip(),
        "examples_of_usage": [example_usage_str],
        "see_also": list(set(see_also)) # Unique list
    }


def generate_detailed_docs(function_info_path, php_file_path):
    try:
        with open(php_file_path, "r", encoding="utf-8") as f:
            php_code_content = f.read()
    except UnicodeDecodeError:
        with open(php_file_path, "r", encoding="latin-1") as f:
            php_code_content = f.read()
    
    php_code_lines = php_code_content.splitlines()

    with open(function_info_path, "r", encoding="utf-8") as f:
        functions_info = json.load(f)

    all_function_names = [f_info['name'] for f_info in functions_info]
    detailed_docs = []

    for func_info_entry in functions_info:
        # Handle the specific case for 'prepare_sql_set' comment if it's problematic
        # This is a temporary workaround for the known issue from previous step.
        if func_info_entry['name'] == 'prepare_sql_set' and func_info_entry['comment'].count("function ") > 1:
            actual_comment_end = func_info_entry['comment'].find("function prepare_sql_set")
            if actual_comment_end != -1:
                 # Attempt to find the true comment for prepare_sql_set before its definition
                 # This is a heuristic: find the @brief before it.
                 brief_marker = "/**  @brief Prepares data for a SET or WHERE clause"
                 brief_pos = func_info_entry['comment'].find(brief_marker)
                 if brief_pos != -1:
                     end_of_brief_comment = func_info_entry['comment'].find("*/", brief_pos) + 2
                     func_info_entry['comment'] = func_info_entry['comment'][brief_pos:end_of_brief_comment]
                 else: # Fallback: just take the first few lines if the specific comment is too mangled
                     func_info_entry['comment'] = "\n".join(func_info_entry['comment'].splitlines()[:5])


        analysis_result = analyze_function(func_info_entry, php_code_lines, all_function_names)
        detailed_docs.append(analysis_result)
        
    return detailed_docs

if __name__ == '__main__':
    if len(sys.argv) < 3:
        print("Usage: python generate_detailed_docs.py <function_info_json_path> <php_source_file_path>", file=sys.stderr)
        sys.exit(1)

    function_info_json_path = sys.argv[1]
    php_source_file_path = sys.argv[2]

    try:
        detailed_documentation = generate_detailed_docs(function_info_json_path, php_source_file_path)
        print(json.dumps(detailed_documentation, indent=2))
    except FileNotFoundError:
        print(f"Error: One or both input files not found.", file=sys.stderr)
        sys.exit(1)
    except Exception as e:
        print(f"An error occurred: {e}", file=sys.stderr)
        sys.exit(1)

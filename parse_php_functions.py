import re
import json
import sys

def parse_php_functions(file_content):
    lines = file_content.splitlines()
    functions_data = []
    
    # Regex to find function definitions, an initial comment block (docblock style), function name, and parameters.
    # It captures:
    # 1. Optional docblock: (/\*\*(.*?)\*/)?
    # 2. Function name: &?([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)
    # 3. Parameters: \((.*?)\)
    # It looks for the opening curly brace { to mark the beginning of the function body.
    # The re.DOTALL flag allows '.' to match newlines, important for multi-line docblocks.
    # The re.MULTILINE flag allows '^' to match at the beginning of each line.
    regex_str = r"^\s*(?:/\*\*(.*?)\*/\s*)??\s*function\s+&?([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*\((?:[^)]*)\)\s*\{"
    function_regex = re.compile(regex_str, re.DOTALL | re.MULTILINE)

    current_pos = 0
    while current_pos < len(file_content):
        match = function_regex.search(file_content, current_pos)
        if not match:
            break

        function_keyword_str_pos = file_content.rfind("function", match.start(0), match.start(2))
        if function_keyword_str_pos == -1 : 
            current_pos = match.end()
            continue

        pre_function_keyword_content = file_content[:function_keyword_str_pos]
        function_declaration_start_line = pre_function_keyword_content.count('\n') + 1

        comment_block_text = ""
        if match.group(1): # Docblock comment
            comment_block_text = "/**" + match.group(1).strip() + "*/"
        else: # Line comments
            temp_comment_lines = []
            for i in range(function_declaration_start_line - 2, -1, -1):
                if i >= len(lines): 
                    continue
                line_content = lines[i].strip()
                if line_content.startswith("#") or line_content.startswith("//"):
                    temp_comment_lines.insert(0, lines[i]) 
                elif line_content.startswith("/*") and line_content.endswith("*/"):
                    temp_comment_lines.insert(0, lines[i])
                    break 
                elif not line_content: 
                    continue
                else: 
                    break
            if temp_comment_lines:
                comment_block_text = "\n".join(temp_comment_lines)
        
        function_name = match.group(2)
        
        open_braces = 1 
        function_end_line = -1
        body_search_pos = match.end(0)
        current_scan_line_num = file_content[:body_search_pos].count('\n')

        for i in range(current_scan_line_num, len(lines)):
            line_to_scan = lines[i]
            
            if i == current_scan_line_num:
                last_newline_before_brace = file_content.rfind('\n', 0, match.end(0)-1)
                # start_char_on_line is the index on lines[i] where the scan should start
                start_char_on_line = (match.end(0) - 1) - (last_newline_before_brace + 1) if last_newline_before_brace != -1 else (match.end(0) -1)
                line_to_scan = lines[i][start_char_on_line + 1:]

            # Basic check for braces within strings or line comments (won't handle block comments in body)
            line_to_scan_no_strings_or_comments = ""
            in_string_double_quote = False
            in_string_single_quote = False
            char_idx = 0
            while char_idx < len(line_to_scan):
                char = line_to_scan[char_idx]
                if char == '"' and (char_idx == 0 or line_to_scan[char_idx-1] != '\\'):
                    in_string_double_quote = not in_string_double_quote
                elif char == "'" and (char_idx == 0 or line_to_scan[char_idx-1] != '\\'):
                    in_string_single_quote = not in_string_single_quote
                elif not in_string_double_quote and not in_string_single_quote:
                    if char == '/' and char_idx + 1 < len(line_to_scan) and line_to_scan[char_idx+1] == '/': # Line comment
                        break # ignore rest of the line
                    line_to_scan_no_strings_or_comments += char
                char_idx += 1
            
            open_braces += line_to_scan_no_strings_or_comments.count('{')
            open_braces -= line_to_scan_no_strings_or_comments.count('}')
            
            if open_braces == 0:
                function_end_line = i + 1 
                break
        
        if function_end_line != -1:
            functions_data.append({
                "name": function_name,
                "start_line": function_declaration_start_line,
                "end_line": function_end_line,
                "comment": comment_block_text.strip()
            })

        if function_end_line != -1:
            temp_pos = 0
            # Count characters until the start of function_end_line (0-indexed)
            for i in range(function_end_line): # Iterate up to the line *after* the function ends
                 if i < len(lines):
                    temp_pos += len(lines[i]) + 1 
                 else: # Should not happen if function_end_line is valid
                    temp_pos +=1 # Minimal advance if lines index is out of bounds
            current_pos = temp_pos
        else: 
            current_pos = match.end(0)


    return functions_data

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print("Usage: python parse_php_functions.py <filepath>", file=sys.stderr)
        sys.exit(1)
    
    filepath = sys.argv[1]
    
    try:
        # Try opening with utf-8 first
        with open(filepath, "r", encoding="utf-8") as f:
            content = f.read()
    except UnicodeDecodeError:
        # If utf-8 fails, try latin-1
        try:
            with open(filepath, "r", encoding="latin-1") as f:
                content = f.read()
        except Exception as e:
            print(f"Error reading file with latin-1: {e}", file=sys.stderr)
            sys.exit(1)
    except FileNotFoundError:
        print(f"Error: File not found at {filepath}", file=sys.stderr)
        sys.exit(1)
    except Exception as e:
        print(f"Error reading file: {e}", file=sys.stderr)
        sys.exit(1)
        
    parsed_functions = parse_php_functions(content)
    print(json.dumps(parsed_functions, indent=2))

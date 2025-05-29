import json
import sys

def generate_markdown_for_function(func_data):
    md_lines = []

    # Function Name
    md_lines.append(f"## `{func_data['function_name']}`")
    md_lines.append("")

    # Description
    md_lines.append("### Description")
    md_lines.append(func_data['description'] if func_data['description'] else "No description provided.")
    md_lines.append("")

    # Parameters
    md_lines.append("### Parameters")
    if func_data['parameters']:
        for param in func_data['parameters']:
            md_lines.append(f"- **Name**: `${param['name']}`")
            md_lines.append(f"  - **Type**: `{param['type']}`")
            md_lines.append(f"  - **Description**: {param['description'] if param['description'] else 'N/A'}")
            if 'example' in param and param['example'] is not None and param['example'] != "":
                md_lines.append(f"  - **Example / Default**: `{param['example']}`")
            md_lines.append("") # Add a little space after each parameter
    else:
        md_lines.append("This function takes no parameters.")
    md_lines.append("")

    # Return Value
    md_lines.append("### Return Value")
    if func_data['return_value']:
        rv = func_data['return_value']
        md_lines.append(f"- **Type**: `{rv['type']}`")
        md_lines.append(f"- **Description**: {rv['description'] if rv['description'] else 'N/A'}")
    else:
        md_lines.append("No return value information available.")
    md_lines.append("")

    # How it Works
    md_lines.append("### How it Works")
    md_lines.append(func_data['how_it_works'] if func_data['how_it_works'] else "No specific information on internal workings provided.")
    md_lines.append("")

    # Examples of Usage
    md_lines.append("### Examples of Usage")
    if func_data['examples_of_usage']:
        for example in func_data['examples_of_usage']:
            md_lines.append("```php")
            md_lines.append(example)
            md_lines.append("```")
    else:
        md_lines.append("No usage examples provided.")
    md_lines.append("")

    # See Also
    md_lines.append("### See Also")
    if func_data['see_also']:
        see_also_links = [f"[`{sa}()`](#{sa.lower()})" for sa in func_data['see_also']] # Basic internal link attempt
        md_lines.append(", ".join(see_also_links))
    else:
        md_lines.append("None.")
    md_lines.append("")

    return "\n".join(md_lines)

def main(detailed_docs_path):
    try:
        with open(detailed_docs_path, "r", encoding="utf-8") as f:
            all_functions_data = json.load(f)
    except FileNotFoundError:
        print(f"Error: Detailed documentation file not found at {detailed_docs_path}", file=sys.stderr)
        sys.exit(1)
    except Exception as e:
        print(f"Error reading or parsing JSON file: {e}", file=sys.stderr)
        sys.exit(1)

    full_markdown_content = []
    for i, func_data in enumerate(all_functions_data):
        full_markdown_content.append(generate_markdown_for_function(func_data))
        if i < len(all_functions_data) - 1:
            full_markdown_content.append("\n---\n") # Separator

    print("\n".join(full_markdown_content))

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print("Usage: python generate_markdown_docs.py <detailed_function_docs_json_path>", file=sys.stderr)
        sys.exit(1)
    
    json_filepath = sys.argv[1]
    main(json_filepath)

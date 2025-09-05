import markdown
import os

def convert_markdown_to_html(root_dir):
    for subdir, _, files in os.walk(root_dir):
        for file in files:
            if file.endswith(".md"):
                md_path = os.path.join(subdir, file)
                html_path = os.path.join(subdir, file.replace(".md", ".html"))

                with open(md_path, "r", encoding="utf-8") as f:
                    md_content = f.read()

                html_content = markdown.markdown(md_content)

                with open(html_path, "w", encoding="utf-8") as f:
                    f.write(html_content)
                print(f"Converted {md_path} to {html_path}")

# Define the directories to convert
base_path = "/home/itrerek/dunia-dalam-kekuatan"
directories_to_convert = [
    os.path.join(base_path, "cerita"),
    os.path.join(base_path, "skills"),
    os.path.join(base_path, "worldbuilding"),
    os.path.join(base_path, "sihir")
]

for directory in directories_to_convert:
    if os.path.exists(directory):
        convert_markdown_to_html(directory)
    else:
        print(f"Directory not found: {directory}")

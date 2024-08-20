import os
import re
import requests
from urllib.parse import urljoin, urlparse


def download_file(url, folder):
    try:
        response = requests.get(url, stream=True)
        response.raise_for_status()
        filename = os.path.basename(urlparse(url).path)
        filepath = os.path.join(folder, filename)
        os.makedirs(folder, exist_ok=True)
        with open(filepath, "wb") as file:
            file.write(response.content)
        return filename
    except requests.RequestException as e:
        print(f"Error downloading {url}: {e}")
        return None


def update_file_paths(file_path, base_url, asset_folder):
    with open(file_path, "r", encoding="utf-8") as file:
        content = file.read()

    # Calculate the relative path from the current file to the root directory
    relative_path_to_root = os.path.relpath(asset_folder, os.path.dirname(file_path))

    # Regular expressions to match URLs in href and src attributes
    href_pattern = r'href="(https://[^"]+)"'
    src_pattern = r'src="(https://[^"]+)"'

    def replace_with_local(match, subfolder):
        url = match.group(1)
        filename = download_file(url, os.path.join(asset_folder, subfolder))
        if filename:
            # Adjust the path relative to the current file's directory
            local_path = os.path.join(relative_path_to_root, subfolder, filename)
            return f'{match.group(0).split("=")[0]}="{local_path}"'
        return match.group(0)  # Return the original if download fails

    # Replace href and src URLs with local paths
    content = re.sub(
        href_pattern, lambda match: replace_with_local(match, "css"), content
    )
    content = re.sub(
        src_pattern, lambda match: replace_with_local(match, "js"), content
    )

    with open(file_path, "w", encoding="utf-8") as file:
        file.write(content)


def scan_and_update_files(directory, base_url, asset_folder):
    os.makedirs(asset_folder, exist_ok=True)
    for root, _, files in os.walk(directory):
        for file in files:
            if file.endswith(".php"):
                file_path = os.path.join(root, file)
                update_file_paths(file_path, base_url, asset_folder)


# Define the directory to scan, the base URL of your website, and the asset folder to save files
directory_to_scan = os.getcwd()  # Current working directory
base_url = "http://localhost/qr-attendance/"
asset_folder = os.path.join(directory_to_scan, "assets")

# Run the script
scan_and_update_files(directory_to_scan, base_url, asset_folder)

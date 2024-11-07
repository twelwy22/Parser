# coded by bloom
# download project in https://github.com/twelwy22/Parser

import requests
from bs4 import BeautifulSoup

def get_page_content(url):
    response = requests.get(url, verify=False)
    return response.text

def parse_content(html):
    soup = BeautifulSoup(html, 'html.parser')

    title = soup.title.text if soup.title else None

    description_tag = soup.find('meta', {'name': 'description'})
    description = description_tag['content'] if description_tag else None

    h1_tags = [h1.text for h1 in soup.find_all('h1')]

    return {
        'title': title,
        'description': description,
        'h1': h1_tags
    }

url = '1' # enter your url
html_content = get_page_content(url)
parsed_data = parse_content(html_content)

print(f"Title: {parsed_data['title']}")
print(f"Description: {parsed_data['description']}")
print("H1 Tags:")
for h1 in parsed_data['h1']:
    print(f"- {h1}")
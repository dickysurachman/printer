#! C:/python/python.exe

import json
from urllib import request

# tentukan url endpoint
url = "http://localhost/printer/site/info.html"

# lakukan http request ke server
response = request.urlopen(url)

# parsing data json
data = json.loads(response.read())

# cetak hasil parsing data
#print(data)
print("Content-Type: text/html\n")
print("Hello, World!")

for i in data['message']:
    print(i['biner'])
    print(i['ulang'])

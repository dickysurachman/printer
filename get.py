#! C:/python/python.exe

import json
from urllib import request

# tentukan url endpoint
url = "http://localhost/printer/printer/site/info.html"
print("Content-Type: text/html\n")
# lakukan http request ke server

try:
    # Intentionally raise an error.
    response = request.urlopen(url)
    #x = 1 / 0
except:
    # Except clause:
    print("Error occurred")
    exit(0)
finally:
    # Finally clause:
    print("The [finally clause] is hit")

# cetak hasil parsing data
#print(data)
#print("Hello, World!")
# parsing data json
data = json.loads(response.read())
for i in data['message']:
    print(i['biner'])
    print(i['ulang'])

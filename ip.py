import socket
import time
import json
import sys
from urllib import request

TCP_IP='11.12.14.20'
TCP_PORT=5015
BUFFER_SIZE=1024
url='http://localhost/printer/printer/site/inforytest.html?key=QG1NXucT67BxTYFTHchtqPIsW7sV76_P_1663043387&lim=500'
response = request.urlopen(url)
def validateJSON(jsonData):
    try:
        json.loads(jsonData)
    except ValueError as err:
        return False
    return True

if validateJSON(response.read())==False:
    print("data kosong")
    sys.exit(0)


print(request.urlopen(url).read())
#sys.exit(0)
data=json.loads(request.urlopen(url).read())
hitungdata = len(data['message'])
print(hitungdata)
for i in data['message']:
    s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    s.connect((TCP_IP,TCP_PORT))
    #MESSAGE='{"command":"DATA","data":{"POD1":"' + i['var_1']+'","POD2":"' + i['var_2']+'","POD3":"' + i['var_3']+'","POD4":"' + i['var_4']+'","POD5":"' + i['var_5']+'"} }' 
    MESSAGE="(90)"+i['var_1']+"(01)"+i['var_2']+"(10)"+i['var_3']+"(17)"+i['var_4']+"(21)"+i['var_5']
    print (MESSAGE)
    s.send(MESSAGE.encode())
    data=s.recv(BUFFER_SIZE)
    print(data.decode())
    s.close()
print(hitungdata)


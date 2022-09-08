import socket
TCP_IP='172.16.20.8'
TCP_PORT=25001
BUFFER_SIZE=1024
from urllib import request
#MESSAGE='00 00 00 00 00 29 00 64 00 25 00 cf 00 00 00 00 13 31 32 31 39 30 32 38 30 31 38 32 30 39 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00'
#MESSAGE='00 00 00 00 00 26 00 64 00 22 00 cf 00 00 00 00 05 62 4d 49 49 31 03 43 43 43 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00'
#MESSAGE='00 00 00 00 00 26 00 64 00 22 00 cf 00 00 00 00 05 42 4d 49 49 31 03 43 43 43 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00'
MESSAGE='00 00 00 00 00 06 00 64 00 02 00 45'

s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
s.send(bytes.fromhex(MESSAGE))
data=s.recv(BUFFER_SIZE)
s.close()
print("receiveddata:")
print(data)
data=str(data)
data=data.replace(" ","")
url1 = "http://localhost/printer/site/camera.html?status="+str(data)
response2 = request.urlopen(url1)
import socket
TCP_IP='172.16.20.3'
TCP_PORT=5000
BUFFER_SIZE=1024
#MESSAGE=b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
MESSAGE='hello'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
s.send(MESSAGE.encode())
data=s.recv(BUFFER_SIZE)
s.close()
print("receiveddata:")
print(data)
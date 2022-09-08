# echo-client.py

import socket
TCP_IP='192.168.20.9'
TCP_PORT=5005
BUFFER_SIZE=1024
#MESSAGE=b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
MESSAGE=b'hello'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
s.sendall(b"Hello, dicky")
data = s.recv(1024)
print(f"Received {data!r}")
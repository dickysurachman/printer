# echo-client.py
import socket
TCP_IP='11.12.14.20'
TCP_PORT=5015
BUFFER_SIZE=1024
#MESSAGE=b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
MESSAGE=b'(90)09214210984902(01)40928048021840(10)B1214(17)010224(21)21098414001'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
i = 1
while i < 100:
  #print(i)
  #s.sendall(b"(90)09214210984902(01)40928048021840(10)B1214(17)010224(21)21098414001")
  s.sendall(b"(90)09214210984902(01)")
  data = s.recv(1024)
  print(f"Received {data!r}")
  i += 1

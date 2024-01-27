# echo-client.py

import socket
#TCP_IP='11.12.14.20'
TCP_IP='192.168.1.20'
TCP_PORT=50002
BUFFER_SIZE=1024
#53 52 2C 30 31 2C 30 33 37 0D 0A 

MESSAGE=b'\x53\x52\x2C\x30\x31\x2C\x30\x33\x37\x0D\x0A'
#MESSAGE=b'(90)09214210984902(01)40928048021840(10)B1214(17)010224(21)21098414001'
#MESSAGE=b'RX,PRG=0000,MarkingEnergy'

#MESSAGE=b'57 58 2c 46 6f 63 75 73 43 68 65 63 6b 3d 30 32'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
#s.sendall(MESSAGE)
	
cmd ="SR,01,037\r\n"
#cmd = 'WX,FocusCheck=02'
#data = s.recv(1024)
#print(f"Received {data}")
s.send(bytes(cmd+'\0','ascii'))
msg = s.recv(1024).decode('ascii')
#msg = s.recv(1024)
print(msg)

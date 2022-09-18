import socket
TCP_IP='192.168.1.5'
TCP_PORT=5010
BUFFER_SIZE=1024
MESSAGE="(90)79879217498712(01)98472391847980(10)1010(17)202025(21)2174980001"
#b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
#MESSAGE='hello'
#s.send(MESSAGE.encode()) 482901XA001
awal="(90)90821482901849(01)90284018204809(10)ACACCA(17)090929(21)482901CCA"
i=1
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
for i in range(101):
	if(i>0):
		hitung="000000"+str(i)
		MESSAGE1=awal+hitung[-3:]
		if((i>=2) and (i<=6)):
			MESSAGE1="(90)FAILED"
		#MESSAGE1=str(i)+str(MESSAGE)
		try:
			s.send(MESSAGE1.encode())
		except :
			s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
			s.connect((TCP_IP,TCP_PORT))
			s.send(MESSAGE1.encode())
	print(i)
s.close()
	#data=s.recv(BUFFER_SIZE)
	#print("receiveddata:",i)
	#print(str(data)+"\n")
#s.close()
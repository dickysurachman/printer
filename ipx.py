import socket
TCP_IP='172.16.20.8'
TCP_PORT=25001
BUFFER_SIZE=1024
MESSAGE=b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
try:
	s.connect((TCP_IP,TCP_PORT))
	#s.settimeout(2.0)
	s.send(MESSAGE)
	data=s.recv(BUFFER_SIZE)
	print("receiveddata:")
	if(data is None) or (str(s).strip()==""):
		print ('data tidak ada') 
	else:
		print(data)
except socket.error:
    	print ('koneksi error')
finally:
    s.close()        

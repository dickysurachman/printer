#! C:/python/python.exe

import json
import socket
from urllib import request
from time import time, sleep
file1 = open('setting.txt', 'r')
Lines = file1.readlines()

print("Content-Type: text/html\n")
def validateJSON(jsonData):
    try:
        json.loads(jsonData)
    except ValueError as err:
        return False
    return True
 
count = 0
settt=[]
# Strips the newline character
for line in Lines:
    count += 1
    settt.append(line.strip())    #print("Line{}: {}".format(count, line.strip()))

TCP_IP=settt[3]
TCP_PORT=settt[4]
BUFFER_SIZE=settt[5]

#print("<br>IP Perangkat ",TCP_IP)
#print("<br>PORT Perangkat ",TCP_PORT)
#print("<br>BUFFER ",BUFFER_SIZE)
#print("<br>URL API",settt[0])
#print("<br>DURASI TIMER (dalam detik)",settt[2])

url = str(settt[0])
response = request.urlopen(url)
baca=""
data = json.loads(response.read())
if validateJSON(response.read())==False:
       print("data kosong<br>")
for i in data['message']:
        print ("<br>",i)
        baca +="hexa pengiriman"+str(i['biner'])
        print("hexa pengiriman",i['biner'])
        print("batas ",i['ulang'])
        MESSAGE=i['biner']
        batas=int(i['ulang'])
        x = 1 
        y=0
        while x <= batas:
            x += 1
            y += 1
            #koneksi ke alat printer
            try:
                s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
                s.connect((str(TCP_IP),int(TCP_PORT)))
                s.send(bytes.fromhex(MESSAGE))
                data=s.recv(int(BUFFER_SIZE))
                s.close()
                print("receiveddata:")
                print(data)
                dua=str(data)
                x1= dua.find("01O")
                #print(x)
                if(x1>0): 
                    print("data berhasil diterima")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=sukses"
                else:
                    print("data gagal dikirim")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=gagal"
                print(url1)
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
            except socket.error:
                url1 = str(settt[1])+"?id="+str(i['id'])+"&status=failure&logbaca=koneksierror"+str(baca.replace(" ",""))
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                print ('koneksi error')
                break
            finally:
                s.close()              
        
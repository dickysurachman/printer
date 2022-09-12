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

print("IP Perangkat ",TCP_IP)
print("PORT Perangkat ",TCP_PORT)
print("BUFFER ",BUFFER_SIZE)
print("URL API",settt[0])
print("DURASI TIMER (dalam detik)",settt[2])
print("URL API COUNTER",settt[6])


while True:
    #y += 1
    sleep(int(settt[2]) - time() % int(settt[2]))
    url = str(settt[0])
    response = request.urlopen(url)
    data = json.loads(response.read())
    baca=""
    if validateJSON(response.read())==False:
        print("data kosong")
    for i in data['message']:
        print (i)
        print("hexa pengiriman",i['biner'])
        baca +="hexa pengiriman"+str(i['biner'])
        print("batas ",i['ulang'])
        MESSAGE=i['biner']
        batas=int(i['ulang'])
        x = 1 
        y=0
        while x <= batas:
            x += 1
            y += 1
            try:
                s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
                s.connect((str(TCP_IP),int(TCP_PORT)))
                #cek hitung pertama
                printd="00 00 00 00 00 06 00 64 00 02 00 A7"                
                s.send(bytes.fromhex(printd))
                data1=s.recv(int(BUFFER_SIZE))
                awal=int(data1[70:74],16)
                print("counter printer pertama ",awal)
                #send data printer
                s.send(bytes.fromhex(MESSAGE))
                data=s.recv(int(BUFFER_SIZE))
                print("receiveddata:")
                print(data)
                dua=str(data)
                x1= dua.find("01O")
                #print(x)
                #cek counter data
                s.send(bytes.fromhex(printd))
                data1=s.recv(int(BUFFER_SIZE))
                akhir=int(data1[70:74],16)
                print("counter printer akhir ",akhir)
                while awal>akhir:
                        s.send(bytes.fromhex(printd))
                        data1=s.recv(int(BUFFER_SIZE))
                        akhir=int(data1[70:74],16)
                        print("counter printer akhir ",akhir)
                if(x1>0): 
                    print("data berhasil diterima")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=sukses"
                else:
                    print("data gagal dikirim")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=gagal"
                print(url1)
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                s.close()
            except socket.error:
                url1 = str(settt[1])+"?id="+str(i['id'])+"&status=failure&logbaca=koneksierror"+str(baca.replace(" ",""))
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                print ('koneksi error')
                break
            finally:
                s.close()              
        
#! C:/python/python.exe

import json
import socket
import binascii
from urllib import request
from time import time, sleep
from datetime import datetime

now = datetime.now()

file_object = open('log-print.txt', 'a')
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
keyyy=settt[6]
current_time = now.strftime(" %d-%M-%Y %H:%M:%S")
print("Start Time =", current_time)
print("IP Perangkat ",TCP_IP)
print("PORT Perangkat ",TCP_PORT)
print("BUFFER ",BUFFER_SIZE)
print("URL API",settt[0])
print("DURASI TIMER (dalam detik)",settt[2])
print("KEY",keyyy)

file_object.write("Start Time  ="+ str(current_time)+"\n")
file_object.write("IP Perangkat "+ str(TCP_IP)+"\n")
file_object.write("Port Perangkat "+ str(TCP_PORT)+"\n")
file_object.write("BUFFER "+ str(BUFFER_SIZE)+"\n")
file_object.write("URL API "+ str(settt[0])+"\n")
file_object.write("Durasi Timer (second) "+ str(settt[2])+"\n")
file_object.write("KEY "+ str(keyyy)+"\n")
#print("URL API COUNTER",settt[6])
file_object.close()

while True:
    #y += 1
    file_object = open('log-print.txt', 'a')
    sleep(int(settt[2]) - time() % int(settt[2]))
    url = str(settt[0])+"?key="+str(keyyy)
    file_object.write(str(url)+"\n")
    response = request.urlopen(url)
    data = json.loads(response.read())
    baca=""
    if validateJSON(response.read())==False:
        print("data kosong")
    for i in data['message']:
        print("data dari server")
        print(i)
        file_object.write("data dari server "+ str(i)+ "\n")
        file_object.write("pengiriman data  s/n "+str(i['var_5']))
        file_object.write("\n")
        print("pengiriman data s/n",i['var_5'])
        baca +="pengiriman data s/n"+str(i['var_5'])
        print("batas ",i['ulang'])
        file_object.write("batas pengiriman "+str(i['ulang']))
        file_object.write("\n")
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
                printd="00 00 00 00 00 06 00 64 00 02 00 45"                
                s.send(bytes.fromhex(printd))
                data1=s.recv(int(BUFFER_SIZE))
                data2=binascii.hexlify(data1).decode()
                try :
                    awal=int(data2[70:74],16)
                except :
                    print ("koneksi error")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=failure&logbaca=koneksierror"+str(baca.replace(" ",""))+"&key="+str(keyyy)
                    response2 = request.urlopen(url1)
                    print(str(y) + " sending to server " +url1)   
                    file_object.write("koneksi error, send "+str(url1)+"\n")
                    break                     
                print("counter printer pertama ",awal)
                file_object.write("counter printer pertama "+str(awal)+"\n")
                file_object.write("\n")
                #send data printer
                s.send(bytes.fromhex(MESSAGE))
                data=s.recv(int(BUFFER_SIZE))
                print("receiveddata:")
                print(data)
                file_object.write("receiveddata :"+str(data)+"\n")
                dua=str(data)
                x1= dua.find("01O")
                #print(x)
                #cek counter data
                s.send(bytes.fromhex(printd))
                data1=s.recv(int(BUFFER_SIZE))
                data2=binascii.hexlify(data1).decode()
                akhir=int(data2[70:74],16)
                print("counter printer akhir ",akhir)
                file_object.write("counter printer akhir "+str(akhir)+"\n")
                while awal>=akhir:
                        s.send(bytes.fromhex(printd))
                        data1=s.recv(int(BUFFER_SIZE))
                        data2=binascii.hexlify(data1).decode()
                        akhir=int(data2[70:74],16)
                        print("counter printer akhir ",akhir)
                        file_object.write("counter printer akhir "+str(akhir)+"\n")
                        sleep(int(settt[2]) - time() % int(settt[2]))
                if(x1>0): 
                    print("data berhasil diterima")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=sukses"+"&key="+str(keyyy)
                    file_object.write("data berhasil diterima \n")
                    file_object.write(str(url1)+"\n")
                else:
                    print("data gagal dikirim")
                    url1 = str(settt[1])+"?id="+str(i['id'])+"&status=gagal"+"&key="+str(keyyy)
                    file_object.write("data gagal dikirim \n")
                    file_object.write(str(url1)+"\n")
                print(url1)
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                s.close()
            except socket.error:
                url1 = str(settt[1])+"?id="+str(i['id'])+"&status=failure&logbaca=koneksierror"+str(baca.replace(" ",""))+"&key="+str(keyyy)
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                print ('koneksi error')
                file_object.write("koneksi error \n")
                file_object.write("sending to server " + str(url1))
                file_object.close()    
                break
            finally:
                s.close()

          
        
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

url = str(settt[0])+"?key="+str(keyyy)
file_object.write(str(url)+"\n")
    try:
        response = request.urlopen(url)
        data = json.loads(response.read())
        baca=""
    except:
        print("koneksi internet error atau machine tidak terdaftar di server")
        file_object.write("internet koneksi error "+str(url)+"\n")
        break
file_object.close()
if validateJSON(response.read())==False:
    print("data kosong")
for i in data['message']:
    file_object = open('log-print.txt', 'a')
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
            #send data printer
            s.send(bytes.fromhex(MESSAGE))
            data=s.recv(int(BUFFER_SIZE))
            print("receiveddata:")
            print(data)
            file_object.write("receiveddata :"+str(data)+"\n")
            dua=str(data)
            s.close()
            file_object.write("send data printer" + str(data)+"\n")
            file_object.write("receiveddata " + str(data)+"\n")
            file_object.close()    
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

          
        
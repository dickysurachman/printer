#! C:/python/python.exe

import json
import socket
import binascii
import time
from urllib import request
#from time import time, sleep
from datetime import datetime

now = datetime.now()

host = socket.gethostname() 
port=2022
ServerSocket = socket.socket()
try:
    ServerSocket.bind((host, port))
except socket.error as e:
    print(str(e))
print(f'Server is listing on {host} the port {port}...')
ServerSocket.listen()

file_object = open('log-print.txt', 'w')
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
#namafile=settt[7]
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
file_object.close()
jalankan=False
while True:
    if jalankan==False:
        jalankan=True
        file_object = open('log-print.txt', 'a')
        url = str(settt[0])+"?key="+str(keyyy)
        file_object.write(str(url)+"\n")
        time.sleep(int(settt[2]))
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
        s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
        s.connect((str(TCP_IP),int(TCP_PORT)))
        hitungdata = len(data['message'])
        #send data printer
        if hitungdata>0 :
            MESSAGE='START'
            s.send(MESSAGE.encode('ascii'))
            databalik=s.recv(int(BUFFER_SIZE))
            print("send:"+MESSAGE)
            print("receiveddata:")
            print(databalik.decode('ascii'))
            #MESSAGE='{"command":"STAR", "templatename":"' + str(namafile) + '", "startpage":"1", "endpage":"'+ str(hitungdata) +'"}'
            #s.send(MESSAGE.encode())
            #databalik=s.recv(int(BUFFER_SIZE))
            #print("send:"+MESSAGE)
            #print("receiveddata:")
            #print(databalik.decode())
            time.sleep(3)
        for i in data['message']:
            file_object = open('log-print.txt', 'a')
            #print("data dari server")
            #print(i)
            #file_object.write("data dari server "+ str(i)+ "\n")
            file_object.write("pengiriman data  s/n "+str(i['var_5']))
            file_object.write("\n")
            print("pengiriman data s/n",i['var_5'])
            baca +="pengiriman data s/n"+str(i['var_5'])
            MESSAGE='MFD|vaar1:'+i['var_1']+'|vaar2:'+ i['var_2']+'|vaar3:'+ i['var_3']+'|vaar4:'+ i['var_4']+'|vaar5:'+ i['var_5']
            #MESSAGE='{"command":"DATA","data":{"POD1":"' + i['var_1']+'","POD2":"' + i['var_2']+'","POD3":"' + i['var_3']+'","POD4":"' + i['var_4']+'","POD5":"' + i['var_5']+'"} }' 
            batas=int(i['ulang'])
            try:
                s.send(MESSAGE.encode('ascii'))
                time.sleep(1)
                databalik=s.recv(int(BUFFER_SIZE))
                print("receiveddata:")
                print(databalik.decode('ascii'))
                file_object.write("receiveddata :"+str(databalik)+"\n")
                dua=str(databalik.decode('ascii'))
                file_object.write("send data printer" + str(MESSAGE)+"\n")
                #file_object.write("receiveddata " + str(data)+"\n")
                    
            except socket.error:
                url1 = str(settt[1])+"?id="+str(i['id'])+"&status=failure&logbaca=koneksierror"+str(baca.replace(";",""))+"&key="+str(keyyy)
                response2 = request.urlopen(url1)
                print(str(y) + " sending to server " +url1)
                print ('koneksi error')
                file_object.write("koneksi error \n")
                file_object.write("sending to server " + str(url1))
                #file_object.close()    
                #break
                #finally:
                    #s.close()
        file_object.close()
        #time.sleep(3)
        s.close()
        jalankan=False
          
        
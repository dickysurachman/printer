import json
import socket
from urllib import request
from time import time, sleep
file1 = open('setting.txt', 'r')
Lines = file1.readlines()

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


while True:
    #y += 1
    sleep(int(settt[2]) - time() % int(settt[2]))
    url = str(settt[0])
    response = request.urlopen(url)
    data = json.loads(response.read())
    if validateJSON(response.read())==False:
        print("data kosong")
    for i in data['message']:
        print (i)
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

            s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
            s.connect((TCP_IP,TCP_PORT))
            s.send(bytes.fromhex(MESSAGE))
            data=s.recv(BUFFER_SIZE)
            s.close()
            print("receiveddata:")
            print(data)
            
            url1 = str(settt[1])+"?id="+str(i['id'])
            response = request.urlopen(url1)
            print(str(y) + " sending to server " +url1)
        
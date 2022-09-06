#! C:/python/python.exe

import socket
from _thread import *
from urllib import request

file1 = open('setting2.txt', 'r')
Lines = file1.readlines()
print("Content-Type: text/html\n")
count = 0
settt=[]
# Strips the newline character
for line in Lines:
    count += 1
    settt.append(line.strip())    #print("Line{}: {}".format(count, line.strip()))

host = socket.gethostname() 
#port = 5000
ThreadCount = 0
url = str(settt[0])
port=int(settt[1])
def client_handler(connection):
    connection.send(str.encode('You are now connected to server...'))
    while True:
        try:
            data = connection.recv(2048)
            message = data.decode('utf-8')
            print(message)
            message= str(message)
            message= message.replace(' ','')
            url1=url+"?&status="+str(message)
            response2 = request.urlopen(url1)
            print("sending to server " +url1)
            if message == 'BYE':
                break
            reply = f'Server: {message}'
            connection.sendall(str.encode(reply))
        except socket.error:
             print ('koneksi error')
             break
        finally: 
            connection.close()

def accept_connections(ServerSocket):
    Client, address = ServerSocket.accept()
    print('Connected to: ' + address[0] + ':' + str(address[1]))
    start_new_thread(client_handler, (Client, ))

def start_server(host, port):
    ServerSocket = socket.socket()
    try:
        ServerSocket.bind((host, port))
    except socket.error as e:
        print(str(e))
    print(f'Server is listing on the port {port}...')
    ServerSocket.listen()

    while True:
        accept_connections(ServerSocket)
start_server(host, port)
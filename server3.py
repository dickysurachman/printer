import socket
from _thread import *

host = socket.gethostname() 
port = 5000
ThreadCount = 0

def client_handler(connection):
    connection.send(str.encode('You are now connected to server...'))
    while True:
        try:
            data = connection.recv(2048)
            message = data.decode('utf-8')
            print(message)
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
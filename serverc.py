# import socket programming library
import socket
 
# import thread module
from _thread import *
import threading
 
print_lock = threading.Lock()

 
# thread function
def threaded(c):
    while True:
 
        # data received from client
        data = c.recv(1024)
        print(data)
        '''
        if not data:
            print('Bye')
             
            # lock released on exit
            print_lock.release()
            break
 
        # reverse the given string from client
        data = data[::-1]
 
        # send back reversed string to client
        c.send(data)
        '''
    # connection closed
    c.close()
 
 
def Main():
    host = ""
    settt=[]
    file1 = open('setting2.txt', 'r')
    count = 0
    Lines = file1.readlines()
    for line in Lines:
        count += 1
        settt.append(line.strip())    #print("Line{}: {}".format(count, line.strip()))
    ThreadCount = 0

    url = str(settt[0])
    port=int(settt[1])
    key=settt[2]
    #host = socket.gethostname() 
    host =str(settt[3]) 
    # reserve a port on your computer
    # in our case it is 12345 but it
    # can be anything
    #port = 12345
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.bind((host, port))
    print("socket binded to port", port)
 
    # put the socket into listening mode
    s.listen(5)
    print("socket is listening")
 
    # a forever loop until client wants to exit
    while True:
 
        # establish connection with client
        c, addr = s.accept()
 
        # lock acquired by client
        print_lock.acquire()
        print('Connected to :', addr[0], ':', addr[1])
 
        # Start a new thread and return its identifier
        start_new_thread(threaded, (c,))
    s.close()
 
 
if __name__ == '__main__':
    Main()
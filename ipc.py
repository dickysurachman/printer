#! C:/python/python.exe

import socket
from datetime import datetime

now = datetime.now()


print("Content-Type: text/html\n")
print("<br>Hello, World!")
print(socket.gethostbyname(socket.gethostname()))
#print("<br>hihihi")
current_time = now.strftime("%H:%M:%S")
print("Current Time =", current_time)
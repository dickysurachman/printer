#! C:/python/python.exe

from time import time, sleep
print("Content-Type: text/html\n")
print("Hello, World!")


y=0
while True:
    y += 1
    sleep(10- time() % 10)
    print(y)
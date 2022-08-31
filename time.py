from time import time, sleep
i=0
while True:
    i=i+1
    sleep(1 - time() % 1)
    print(i)
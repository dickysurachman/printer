#! C:/python/python.exe

file1 = open('setting.txt', 'r')
Lines = file1.readlines()
count = 0
settt=[]
for line in Lines:
    count += 1
    settt.append(line.strip())    #print("Line{}: {}".format(count, line.strip()))

TCP_IP=settt[3]
TCP_PORT=settt[4]
BUFFER_SIZE=settt[5]

print("Content-Type: text/html\n")
print("IP Perangkat ",TCP_IP)
print("PORT Perangkat ",TCP_PORT)
print("BUFFER ",BUFFER_SIZE)
print("URL API",settt[0])
print("DURASI TIMER (dalam detik)",settt[2])
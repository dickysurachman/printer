import asyncio
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

ThreadCount = 0
url = str(settt[0])
port=int(settt[1])
key=settt[2]
host =str(settt[3])
async def handle_client(reader, writer):
    data = await reader.read(100)
    message = data.decode()
    addr = writer.get_extra_info('peername')
    print(f"Received {message!r} from {addr!r}")
    url1=url+"?status="+str(message)+"&key="+str(key)
    request.urlopen(url1)
    print("sending to server " +url1)
    # Simulate an asynchronous operation (e.g., database query, file I/O)
    await asyncio.sleep(1)
    response = f"Processed: {message}"
    print(f"Send: {response!r}")
    writer.write(response.encode())
    await writer.drain()
    print("Closing the connection")
    writer.close()

async def main():
    server = await asyncio.start_server(
        handle_client, host,port)

    addr = server.sockets[0].getsockname()
    print(f'Serving on {addr}')

    async with server:
        await server.serve_forever()

if __name__ == "__main__":
    asyncio.run(main())

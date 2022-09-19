import socket
import threading
import binascii
import time

host='192.168.20.9'
local_port=5000
ip_port = (host, int(local_port))
BUFSIZE = 1024

def accept_concurrency(self):
    while True:  
        try:
            conn, addr = s.accept()
        except Exception as ret:
                time.sleep(0.001)
        else:
                s_th = threading.Thread(
                target=tcp_server_concurrency, args=(
                        conn, addr))
                s_th.setDaemon(True)
                s_th.start()
def tcp_server_concurrency( conn, addr):
        show_client_info = True
        statusbar_client_info = '%s:%d' % (addr[0], addr[1])
        print(statusbar_client_info)
        while True:
            try:
                recv_msg = conn.recv(BUFSIZE)  # 接受消息的内容
            except ConnectionResetError as con_rest:
                print('Error:', con_rest)
                conn.close()
                break
            else:
                print(recv_msg)
                if recv_msg:
                        try:
                            msg = recv_msg.decode('utf-8')
                            print(msg)
                        except Exception as ret:
                            print ("error")
                else:
                    conn.close()
                    break

s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
#s = socket()
#s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)  # 创建TCP套接字
try:
    s.bind(ip_port)  # 绑定地址
    s.listen(5)  # 监听链接
except Exception as ret:
    print('Error:', ret)
    # 关闭tcp socket
    s.socket_close()    
else:
    print('server listening...')
    accept_th = threading.Thread(accept_concurrency)
    accept_th.setDaemon(True)
    accept_th.start()

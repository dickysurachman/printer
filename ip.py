import socket
TCP_IP='172.16.20.8'
TCP_PORT=5000
BUFFER_SIZE=1024
MESSAGE=b'\x00\x00\x00\x00\x00\x26\x00\x64\x00\x22\x00\xcf\x00\x00\x00\x00\x05\x41\x4d\x49\x49\x38\x03\x43\x43\x43\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\r'
#MESSAGE='hello'
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect((TCP_IP,TCP_PORT))
s.send(MESSAGE.encode())
data=s.recv(BUFFER_SIZE)
s.close()
print("receiveddata:")
print(data)


 def tcp_server_concurrency(self, conn, addr):
        """
        功能函数，为每个tcp连接创建一个线程；
        使用子线程用于创建连接，使每个tcp client可以单独地与server通信
        :return:None
        """
        # 这里的show_client_info标志位的作用：仅在收到客户端发送的第一次消息前面加上客户端的ip，port信息
        show_client_info = True
        # 将连接到本服务器的客户端信息显示在客户端列表下拉框中
        statusbar_client_info = '%s:%d' % (addr[0], addr[1])
        while True:
            try:
                recv_msg = conn.recv(self.BUFSIZE)  # 接受消息的内容

            # 当用户直接点击关闭按钮关闭客户端时，显示主机强制关闭的异常，否则服务器端会奔溃
            except ConnectionResetError as con_rest:
                """
                    这里要写成 ConnectionResetError ，
                    如果写成 Expection ，会导致软件进入监听状态，并且有客户端连入后，
                    点击 “断开” 按钮一次，出现 'Remote Client disconnected' 提示信息
                    单机 “断开” 按钮第二次，才会真正断开服务器的socket
                    （总结成一句话，写成Expection会导致点两次 “断开” 才能关闭服务器）
                """
                print('Error:', con_rest)
                conn.close()
                print(self.client_socket_list)
                # 将当前客户端的连接从socket列表中删除
                self.client_socket_list.remove((conn, addr))
                print(self.client_socket_list)
                # 判断socket列表是否已经清空，如果清空，那么self.link置为空
                if self.client_socket_list:
                    pass
                else:
                    self.link = False

                # 将已断开连接的客户端信息从客户端列表下拉box中删除
                self.comboBox_removeItem_byName(
                    self.clients_list, statusbar_client_info)
                # 状态栏显示客户端断开信息
                self.signal_status_removed.emit(statusbar_client_info)
                """
                   下面的break会导致跳出当前接收消息的循环，从而进入监听循环，等待下一个conn。
                   这样的好处是，当客户端断开连接后，服务器并不会断开socket，而是仅仅断开conn。
                   当客户端再一次连接到服务器时，服务器仍可以为其开辟新的conn，并且服务器发送消息的功能运行正确。
                   """
                break
            else:
                print(recv_msg)
                if recv_msg:
                    # 16进制显示功能检测
                    if self.hex_recv.isChecked():
                        msg = binascii.b2a_hex(recv_msg).decode('utf-8')
                        # 例子：str(binascii.b2a_hex(b'\x01\x0212'))[2:-1] == >
                        # 01023132
                        print(msg, type(msg), len(msg))  # msg为 str 类型
                        # 将解码后的16进制数据按照两个字符+'空字符'发送到接收框中显示
                        msg = self.hex_show(msg)
                        if show_client_info is True:
                            # 将接收到的消息发送到接收框中进行显示，附带客户端信息
                            connect_info = '[Remote IP %s Port: %s ]\n' % addr
                            self.signal_add_clientstatus_info.emit(
                                connect_info)
                            self.signal_write_msg.emit(msg)
                            # 仅在收到客户端发送的第一次消息前面加上客户端的ip，port信息
                            show_client_info = False
                        else:
                            self.signal_write_msg.emit(msg)
                    else:
                        try:
                            # 尝试对接收到的数据解码，如果解码成功，即使解码后的数据是ascii可显示字符也直接发送，
                            msg = recv_msg.decode('utf-8')
                            print(msg)
                            if show_client_info is True:
                                # 将接收到的消息发送到接收框中进行显示，附带客户端信息
                                connect_info = '[Remote IP %s Port: %s ]\n' % addr
                                self.signal_add_clientstatus_info.emit(
                                    connect_info)
                                self.signal_write_msg.emit(msg)
                                # 仅在收到客户端发送的第一次消息前面加上客户端的ip，port信息
                                show_client_info = False
                            else:
                                self.signal_write_msg.emit(msg)
                        except Exception as ret:
                            # 如果出现解码错误，提示用户选中16进制显示
                            self.signal_messagebox_info.emit('解码错误，请尝试16进制显示')

                    # 将接收到的数据字节数显示在状态栏的计数区域
                    self.rx_count += len(recv_msg)
                    self.statusbar_dict['rx'].setText(
                        '接收计数：%s' % self.rx_count)

                else:
                    # 当前客户端连接主动关闭，但服务器socket并不关闭
                    conn.close()
                    # 将当前客户端的连接从列表中删除
                    self.client_socket_list.remove((conn, addr))
                    # 将已断开连接的客户端信息从客户端列表下拉box中删除
                    self.comboBox_removeItem_byName(
                        self.clients_list, statusbar_client_info)
                    # 状态栏显示客户端断开信息
                    self.signal_status_removed.emit(statusbar_client_info)

                    break

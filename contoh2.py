#!C:\python\python.exe



satu=str(b'\x00\x00\x00\x00\x00\x07\x01d\x00\x03\x011\x14')

x = satu.find("01O")
print(x)
if(x>0): print("data berhasil diterima")

#print(satu.decode('hex'))
dua=str(b'\x00\x00\x00\x00\x00\x06\x01d\x00\x02\x01O')
#print(dua.decode('hex'))
x = dua.find("01O")
print(x)
if(x>0): print("data berhasil diterima")

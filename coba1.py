import binascii
data=b"\00\00\00\00\00?\01d\00;\01E\01\00\00\00\00\00\00\00\00\00\00\00\00\00\00\00\00\00\00\00\n\00\00\02O\00\01\84X\00\00\00\00@0gy\9d\e6w\9a@ \d1\eb\85\1e\b8R\00\02\05#\00\00\00\05"

#p=binascii.unhexlify(data)
print(data.hex())
data2=binascii.hexlify(data).decode()
print(data2)

print(data2[62:66])
print(data2[70:74])

print( int(data2[62:66],16))
print( int(data2[70:74],16))
#print(p)
awal=10
akhir=1
x1=0
while awal>akhir:
		akhir +=1
		print("counter printer akhir ",akhir)
if(x1>0): 
	print("data berhasil diterima")
else:
	print("data gagal dikirim")

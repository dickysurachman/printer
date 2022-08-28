#! C:\python\python.exe
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="printer"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT * FROM user")

myresult = mycursor.fetchall()

for x in myresult:
  print(x)
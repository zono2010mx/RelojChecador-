import mysql.connector as db
from mysql.connector import Error

def convertToBinaryData(filename):
    # Convert digital data to binary format
    try:
        with open(filename, 'rb') as file:
            binaryData = file.read()
        return binaryData
    except:
        return 0    
    
def write_file(data, path):
    # Convert binary data to proper format and write it on your computer
    with open(path, 'wb') as file:
        file.write(data)

def registerUser(name, photo):
    id = 0
    inserted = 0

    try:
        connection = db.connect(
                host='localhost',
                user='root',
                password='',
                database='basedatos'
            )
        cursor = connection.cursor()
        #sql = "UPADTE `trabajadores`(name, photo) VALUES (%s,%s)"
        sql = "UPADTE `trabajadores` set foto = %s WHERE nombre = %s"
        pic = convertToBinaryData(photo)

        if pic:
            cursor.execute(sql, (pic, name))
            connection.commit()
            inserted = cursor.rowcount
            id = cursor.lastrowid
    except db.Error as e:
        print(f"Failed inserting image: {e}")
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()
    return {"id": id, "affected":inserted}

def getUser(name, path):
    id = 0
    rows = 0

    try:
        connection = db.connect(
                host='localhost',
                user='root',
                password='',
                database='basedatos'
            )
        cursor = connection.cursor()
        sql = "SELECT * FROM `user` WHERE name = %s"

        cursor.execute(sql, (name,))
        records = cursor.fetchall()

        for row in records:
            id = row[0]              #Se encuantra el id en la posicion 0 de la tabla en la base de datos
            write_file(row[16], path) #Se encuantra la imagen en la posicion 16 de la tabla en la base de datos
        rows = len(records)
    except db.Error as e:
        print(f"Failed to read image: {e}")
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()
    return {"id": id, "affected": rows}
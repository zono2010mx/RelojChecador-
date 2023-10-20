import cv2
import os
from mtcnn.mtcnn import MTCNN
from matplotlib import pyplot as plt
import sys
import mysql.connector as db
from mysql.connector import Error

argumento = sys.argv[1] 

path = 'C:/xampp/htdocs/relojChecador/'

def face(img, faces):
    data = plt.imread(img)
    for i in range(len(faces)):
        x1, y1, ancho, alto = faces[i]["box"]
        x2, y2 = x1 + ancho, y1 + alto
        plt.subplot(1,len(faces), i + 1)
        plt.axis("off")
        face = cv2.resize(data[y1:y2, x1:x2],(150,200), interpolation=cv2.INTER_CUBIC)
        cv2.imwrite(img, face)
        plt.imshow(data[y1:y2, x1:x2])

def convertToBinaryData(filename):
    # Convert digital data to binary format
    try:
        with open(filename, 'rb') as file:
            binaryData = file.read()
        return binaryData
    except:
        return 0  

def register_face_db(img):
    img.replace(".jpg","").replace(".png","")
    photo = img
    name = argumento  
    
    connection = db.connect(
                host='localhost',
                user='root',
                password='',
                database='basedatos'
            )
    cursor = connection.cursor()
    sql = "UPDATE `trabajadores` SET foto = %s WHERE nombre = %s"
    pic = convertToBinaryData(photo)
    
    cursor.execute(sql, (pic, name))
    connection.commit() 
 
    if connection.is_connected():
        cursor.close()
        connection.close() 
    
    print("Resultado exitoso")
    os.remove(img)  

# Inicializar la cámara web
cap = cv2.VideoCapture(0)  # 0 representa la cámara predeterminada (puede variar según tu configuración)
img = f"{argumento}.jpg"

while True:
    # Capturar un fotograma de la cámara
    ret, frame = cap.read()

    # Mostrar el fotograma en una ventana
    cv2.imshow('Cámara Web', frame)

    # Salir del bucle si se presiona la tecla 'space'
    if cv2.waitKey(1) == 32:
        cv2.imwrite(img, frame)
        break

    elif cv2.waitKey(1) == 49: # Salir del bucle si se presiona la tecla '1'
        cap.release()
        cv2.destroyAllWindows()
        sys.exit(0)

# Liberar la cámara y cerrar la ventana
cap.release()
cv2.destroyAllWindows()

pixels = plt.imread(img)
faces = MTCNN().detect_faces(pixels)
 
face(img, faces) 
register_face_db(img)

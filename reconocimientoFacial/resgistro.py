import cv2
import database as db
import os
from mtcnn.mtcnn import MTCNN
from matplotlib import pyplot as plt
import sys

argumento = sys.argv[1] if len(sys.argv) > 1 else None

if argumento is not None:
    print("Dato recibido desde PHP:", argumento)
else:
    print("No se recibieron datos desde PHP")
    
"""
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

def register_face_db(img):
    name_user = img.replace(".jpg","").replace(".png","")
    res_bd = db.registerUser(name_user, path + img)

    if(res_bd["affected"]):
        print("Image guardada en la BD")
    else:
        print("fallo al agregfar")
    os.remove(img)

id_user = input("Por favor, dame el nombre: ")

# Inicializar la cámara web
cap = cv2.VideoCapture(0)  # 0 representa la cámara predeterminada (puede variar según tu configuración)
img = f"{id_user}.jpg"

while True:
    # Capturar un fotograma de la cámara
    ret, frame = cap.read()

    # Mostrar el fotograma en una ventana
    cv2.imshow('Cámara Web', frame)

    # Salir del bucle si se presiona la tecla 'q'
    if cv2.waitKey(1) == 27:
        cv2.imwrite(img, frame)
        break

# Liberar la cámara y cerrar la ventana
cap.release()
cv2.destroyAllWindows()

pixels = plt.imread(img)
faces = MTCNN().detect_faces(pixels)
    
face(img, faces) 
register_face_db(img)
"""

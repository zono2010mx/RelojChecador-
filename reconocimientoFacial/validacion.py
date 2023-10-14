import cv2
import database as db
import os
from mtcnn.mtcnn import MTCNN
from matplotlib import pyplot as plt

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

def compatibility(img1, img2):
    orb = cv2.ORB_create()

    kpa, dac1 = orb.detectAndCompute(img1, None)
    kpa, dac2 = orb.detectAndCompute(img2, None)

    comp = cv2.BFMatcher(cv2.NORM_HAMMING, crossCheck=True)

    matches = comp.match(dac1, dac2)

    similar = [x for x in matches if x.distance < 70]
    if len(matches) == 0:
        return 0
    return len(similar)/len(matches)

id_user = input("Por favor, dame el nombre: ")

cap = cv2.VideoCapture(0)
img = f"{id_user}_login.jpg"               #imagen de la base de datos
imgComparation = f"{id_user}.jpg"       #imagen para comparacion 


while True:
    # Captura un fotograma desde la cámara
    ret, frame = cap.read()

    # Muestra el fotograma en una ventana
    cv2.imshow('Login facial', frame)

    # Sale del bucle si se presiona la tecla 'esc'
    if cv2.waitKey(1) == 27:
        cv2.imwrite(img, frame)
        break

# Libera la cámara y cierra la ventana
cap.release()
cv2.destroyAllWindows()

pixels = plt.imread(img)
faces = MTCNN().detect_faces(pixels)

face(img, faces)

res_db = db.getUser(id_user, path + imgComparation)
if(res_db["affected"]):
    my_files = os.listdir()
    if imgComparation in my_files:
        face_reg = cv2.imread(imgComparation, 0)
        face_log = cv2.imread(img, 0)

        comp = compatibility(face_reg, face_log)
        
        if comp >= 0.94:
            print("Bienvenido usuario")
        else:
            print("Error compatibilidad")
        os.remove(imgComparation)

    else:
        print("¡Error! Usuario no encontrado")
else:
    print("¡Error! Usuario no encontrado")
os.remove(img)
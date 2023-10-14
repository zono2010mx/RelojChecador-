<?php

class metodos{
    ////////////////////// Mostrar datos ///////////////////////
    public function mostrarDato($user_id){
        $c = new conexionBD();
        $conectar = $c-> conexion();  //conexion a la BD llamando al objeto conexionBD que esta en conexionBD.php
 
        $sql = "SELECT nombre,ap_paterno,ap_materno,foto FROM trabajadores WHERE id_trabajador = '$user_id'";

        $result = mysqli_query($conectar,$sql);

        if ($result->num_rows > 0) {  //Devuelve el número de filas de un conjunto de resultados.
            return $result->fetch_assoc(); //Si existe te dará un arreglo asociativo con la inforacion del usuario
        } else {
            return null;
        }
    }

    public function mostrarChecada($user_id){
        $c = new conexionBD();
        $conectar = $c-> conexion();  
 
        $sql = "SELECT fecha,hora FROM checadas WHERE id_trabajador = '$user_id' ORDER BY id_checada DESC";

        $result = mysqli_query($conectar,$sql);

        if ($result->num_rows > 0) {  
            return $result->fetch_assoc(); 
        } else {
            return null;
        }
    }

    ////////////////////// Insertar datos ///////////////////////

    public function insertarDatos($datos){
        $c = new conexionBD();
        $conectar = $c-> conexion();  

        $sql = "INSERT INTO trabajadores (nombre, ap_paterno, ap_materno, RFC, contrato, email, titulo) 
                                VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]');";

        return $result = mysqli_query($conectar,$sql);            

    }
    
    public function insertarChecada($date_array){
        $c = new conexionBD();
        $conectar = $c-> conexion();  

        $sql = "INSERT INTO checadas (id_trabajador, fecha, hora) 
        VALUES ('$date_array[0]', '$date_array[1]', '$date_array[2]');";

        return $result = mysqli_query($conectar,$sql);  

    }

    ////////////////////// Actualizar datos ///////////////////////

    public function actualizarDatos($datos){
        $c = new conexionBD();
        $conectar = $c-> conexion();

        $sql = "UPDATE trabajadores 
        set nombre='$datos[0]', ap_paterno='$datos[1]', ap_materno='$datos[2]', sexo='$datos[3]', RFC='$datos[4]', 
        CURP='$datos[5]', contrato='$datos[6]', tipo_trabajador='$datos[7]', total_Horas='$datos[8]', Estatus='$datos[9]',
        email='$datos[10]', titulo='$datos[11]', codigo_tarjeta='$datos[12]', fecha_ingreso='$datos[13]'
        WHERE id_trabajador='$datos[14]'";

        return $result = mysqli_query($conectar,$sql);

    }


    ////////////////////// Eliminar datos ///////////////////////

    public function eliminarDatos($id){
        $c = new conexionBD();
        $conectar = $c-> conexion();  
        $sqlC = "DELETE from trabajadores WHERE id_trabajador='$id'";
        return $result = mysqli_query($conectar,$sqlC);
    }
}

?>
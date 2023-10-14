<?php

require_once "conexionBD.php"; 
require_once "metodosCRUD.php";

if(isset($_POST['eliminar'])){
    $id = $_POST['id_trabajador'];
    $nombre = $_POST['nombre'];

    $obj = new metodos();
    $obj->eliminarDatos($id);

    echo "<script> alert('El empleado [$nombre] se elimino correctamente'); location.href='../consultas.php'</script>";
}else {
    echo "<script> alert('Eror al eliminar'); location.href='../consultas.php';</script>";
}


?>
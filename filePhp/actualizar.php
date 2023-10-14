<?php

require_once "conexionBD.php"; 
require_once "metodosCRUD.php";

$id = $_POST['txtNumero'];
$nombre = $_POST['txtNombre'];                  $ap_paterno = $_POST['txtApellidoP'];
$ap_materno = $_POST['txtApellidoM'];           $fecha = $_POST['txtFecha'];
$sexo = $_POST['txtSexo'];                      $RFC = $_POST['txtRFC'];
$CURP = $_POST['txtCURP'];                      $contrato = $_POST['contrato_user'];
$tipo_Trabajador = $_POST['txtTipoTrabajador']; $horas_Total = $_POST['txtHoras'];
$status = $_POST['txtStatus'];                  $email = $_POST['txtEmail'];
$titulo = $_POST['txtTitulo'];                  $codigo_Tarjeta = $_POST['txtCodigoTarjeta'];

////////////////Actualiza los demas datos del profesor

$datos = array(
    $nombre, $ap_paterno, $ap_materno, $sexo, $RFC, $CURP, $contrato, $tipo_Trabajador, 
    $horas_Total, $status, $email, $titulo, $codigo_Tarjeta, $fecha, $id
);

$obj = new metodos();
$obj->actualizarDatos($datos);

////////////////Recargar la pagina despues de una actulizacion, me aparezca el mismo perfil en editar.php o ir a consultas.php

$conexion = new conexionBD();
$conBD = $conexion-> conexion();

$sql = "SELECT id_trabajador FROM trabajadores WHERE id_trabajador ='$id'";

$resultado = $conBD->query($sql);
$row = $resultado->fetch_assoc();

echo "<script> 
        var respuesta = confirm('¿Desea actualizar otros datos?'); 
        if (respuesta == true) {
            location.href='../editar.php?id_trabajador=".$row["id_trabajador"]."';
        } else {
            location.href='../consultas.php';
        }
    </script>";

?>
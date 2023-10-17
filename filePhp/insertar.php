<?php

session_start();
require_once "conexionBD.php"; 
require_once "metodosCRUD.php";

$nombre = $_POST['nombre_user'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$rfc = $_POST['rfc_user'];
$contrato = $_POST['contrato_user'];
$titulo = $_POST['titulo_user'];
$email = $_POST['email_user'];

if($contrato == '- - -') $contrato = null;

$datos = array(
    $nombre,
    $ap_paterno,
    $ap_materno,
    $rfc,
    $contrato,
    $email,
    $titulo
);

if ($contrato == null) {
    $_SESSION['mensaje'] = "No selecciono el tipo de contrato";
    header("Location:../altas.php");
    exit();
    
} else {
    $obj = new metodos();
    $obj->insertarDatos($datos);
    header("location:../altas.php");
}

?>
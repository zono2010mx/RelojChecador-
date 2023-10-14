<?php

require_once "conexionBD.php"; 
require_once "metodosCRUD.php";

$c = new conexionBD();
$conn = $c-> conexion();

$columns = ['id_trabajador', 'nombre', 'ap_paterno', 'ap_materno', 'RFC', 'contrato', 'titulo', 'email'];
$table = "trabajadores";

$id = 'id_trabajador';

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns); //Guarda el numero de columnas
    for ($i=0; $i < $cont; $i++) { 
        $where .= $columns[$i] . " LIKE '%". $campo ."%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

/* Mostrado resultados */
$output = [];
$output['data'] = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {

        $user_fullname = $row['nombre'] . ' ' . $row['ap_paterno'].' '. $row['ap_materno'];
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['id_trabajador'] . '</td>';
        $output['data'] .= '<td>' . $user_fullname . '</td>';
        $output['data'] .= '<td>' . $row['RFC'] . '</td>';
        $output['data'] .= '<td>' . $row['contrato'] . '</td>';
        $output['data'] .= '<td>' . $row['titulo'] . '</td>';
        $output['data'] .= '<td>' . $row['email'] . '</td>';
        $output['data'] .= '<td>
        <form action="editar.php" method="GET"> <!--Formulario para eliminar un profesor-->
            <a class="btn btn-warning btn-sm" href="editar.php?id_trabajador='.$row['id_trabajador'].'">
            Editar
            </a>
        </form>
        </td>';
        $output['data'] .= "<td>
        <form action='filePhp/eliminar.php' method='POST'> <!--Formulario para eliminar un profesor-->
            <input type='hidden' name='id_trabajador' value='". $row['id_trabajador'] ."'>
            <input type='hidden' name='nombre' value='". $row['nombre'] ."'>  <!--Click que llama al cuadro de dialgo de confimracion-->
            <input type='submit' name='eliminar' value='eliminar' onclick='return confirmacion()'>
        </form>
        </td>";
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="8">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
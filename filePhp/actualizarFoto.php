<?php

$pythonScript = "../reconocimientoFacial/resgistro.py";
$id = $_POST['inpNumero'];
$argumento = $_POST['inpNombre']; // Dato a enviar al script de Python

$cmd = "python $pythonScript $argumento";

// Ejecuta el script de Python utilizando la función shell_exec()
$output = shell_exec($cmd);

if ($output !== null) {
    echo "Resultado de Python: " . $output; //Echo para retornar la funciónde de python
    echo "<script> 
    location.href='../editar.php?id_trabajador=".$id."';
    </script>";

} else {
    echo "<script> 
    location.href='../editar.php?id_trabajador=".$id."';
    </script>";
}
  
?>
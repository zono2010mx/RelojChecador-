<?php

if(!empty($_FILES['imagefile']['tmp_name']) 
    && file_exists($_FILES['imagefile']['tmp_name'])) {
        $foto = addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));

        $pythonScript = "../reconocimientoFacial/resgistro.py";

        $argumento = $_POST['txtNombre']; // Dato que deseas enviar al script de Python
        $cmd = "python $pythonScript $argumento";

        // Ejecuta el script de Python utilizando la función shell_exec()
        $output = shell_exec($cmd);

        if ($output !== null) {
                  
        } else {
            echo "Error al ejecutar el script de Python";
        }
}

?>
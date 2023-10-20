<?php

require_once "filePhp/conexionBD.php"; 
require_once "filePhp/metodosCRUD.php";

$database = new metodos();                                                       // Crea un objeto de la clase metodos en metodosCRUD.php;

if ($_SERVER["REQUEST_METHOD"] == "POST") {                                      // Verifica si se ha enviado el formulario por POST

    $pythonScript = "reconocimientoFacial/validacion.py";                         //Scrip de python
    $user_id = $_POST['user_id'];                                                // Obtener el ID del usuario desde el formulario
    $fecha = date("Y-m-d");                                                      //Obtiene la fecha
    $fechaAnterior = date("Y-m-d", strtotime($fecha . " -1 day"));               // Resta un día a la fecha actual
    date_default_timezone_set('America/Cancun'); $hora_actual = date("H:i:s");   //Obtiene la hora

    $cmd = "python $pythonScript $user_id"; #envia el dato al script de python
    $output = shell_exec($cmd);
    $resultado = file_get_contents("output.txt");

    if ($resultado == "Bienvenido usuario") {

        $user_data = array();                                                      //Array para mostrar el nombre
        $date_array = array($user_id, $fechaAnterior, $hora_actual);               //Array para guardar la checada

        $user_data = $database->mostrarDato($user_id); // Obtener los datos del usuario por la funcion del objeto metodos en metodosCRUD.php;

        // Verificar si el arreglo $user_data contiene datos antes de acceder a un índice, y el resultado lo imprime en el input de "nombre"
        if ($user_data !== null && isset($user_data['nombre']) && isset($user_data['ap_paterno']) && isset($user_data['ap_materno'])){
            // Concatenar nombre y apellido para imprimirlo
            $user_fullname = $user_data['nombre'] . ' ' . $user_data['ap_paterno'].' '. $user_data['ap_materno'];
            $user_photo = $user_data['foto'];

            //Guardar la hora y la fecha del chequeo en la base de datos
            $ChecadaSave = new metodos();
            $ChecadaSave->insertarChecada($date_array);
            
            //Imprime la fecha y la hora de la checada
            $checada_fecha = array();
            $checada_fecha = $database->mostrarChecada($user_id);

            $fecha_Hora = $checada_fecha['fecha'] . ' ' . $checada_fecha['hora'];

        }else {
            $user_fullname = 'Usuario no encontrado';
        }

    } else if ($resultado == "Error compatibilidad") {
        $user_fullname = 'Usuario no encontrado';
    }

    $tiempoEspera = 5;
    $urlRedireccion = $_SERVER['REQUEST_URI'];   // Obtiene la URL actual (la página actual) y la redirige después del tiempo de espera
    header("refresh:$tiempoEspera;url=$urlRedireccion"); // Envía una respuesta de encabezado HTTP con la instrucción de redirección
}

$archivo = "output.txt";

if (file_exists($archivo)) {
    unlink($archivo);
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checador</title>
    <link rel="stylesheet" href="hojasCSS/cliente.css" type="text/css">
</head>

<body>
    <!---------------------------------Encabezado---------------------------------------------->
    <header>
        <img id="logoTecnm" src="img/logoTECNMblanco.png">
        <label id="letrasITC">INSTITUTO TECNOLOGICO DE CANCUN</label>
        <img id="imagenITC" src="img/logoITC.png" /> 
    </header>

    <!---------------------------------Seccion---------------------------------------------->

    <section>
        <!--Area de notas-->
        <textarea readonly="readonly" id="areaNotas" rows="23" cols="50" ></textarea>
        
        <!--Fecha y hora-->
        <div id="fechaHoraDatos">

            <form method="post" id="insertarDatos">
                <p id="date">date</p>
                <b id="time" style="font-size: 70px;">00:00:00</b>
                <script src="js/reloj.js"></script>
              
            <!--Datos-->
                <div id="id_Usuario">
                    <label for="user_id">Ingresa su ID de usuario:</label>
                    <input type="text" id="user_id" name="user_id">
                    <button id="miBoton">Checar</button>
                </div>
            </form>

            <form>
                <label for="nombre">Nombre:</label><br>
                <?php if (!empty($user_fullname)) : ?> <!--Verifica si la variable no esta vacia-->
                <input type="text" id="nombre" name="nombre" readonly="readonly" size="50" style="font-size: 20px;" value="<?php echo $user_fullname; ?>">
                <?php endif; ?> <!--Fin de la verificacion-->

                <br><label for="fecha">Fecha y hora de checada</label><br>
                <?php if (!empty($fecha_Hora)) : ?> <!--Verifica si la variable no esta vacia-->
                <input type="text" id="fecha" name="fecha" readonly="readonly" style="font-size: 20px;" value="<?php echo $fecha_Hora; ?>">
                <?php endif; ?> <!--Fin de la verificacion-->
            </form>

        </div>

        <!--Foto de perfil-->
        <img id="imagenPerfil" src="data:image/jpg;base64,<?php echo base64_encode($user_photo); ?>" alt="imagenProfesor">

    </section>
        
</body>
</html>
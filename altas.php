<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altas</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!--Cuadro de alerta perzonalizado-->
    <link rel="stylesheet" href="hojasCSS/altasCSS.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

        <img id="logoTecnm" src="img/logoTECNMR.png" style="width: 400px; height: 600px; opacity: 0.5;">
        
        <div id="main">
        <a href="menuAdmin.html"><img src="img/paginaPrincipal.png"><p>Pagina principal</p></a>
        </div>

        <form class="formulario_alta" method="post" action="filePhp/insertar.php">
            <h1>Altas de profesores</h1>
            <label>Nombre</label>
            <input class="formulario_seccion" required type="text" id="nombre_user" name="nombre_user"><br>
            <label>Apellido paterno</label>
            <input class="formulario_seccion" required type="text" id="ap_paterno" name="ap_paterno"><br>
            <label>Apellido materno</label>
            <input class="formulario_seccion" required type="text" id="ap_materno" name="ap_materno"><br>
            <label>RFC</label>
            <input class="formulario_seccion" required type="text" id="rfc_user" name="rfc_user"><br>
            
            <label for="contrato">Contrato</label>
            <select name="contrato" id="contrato">
                <option style="font-size: medium;">- - -</option>
                <option value="Base">Base</option>
                <option value="Por horas">Por horas</option>
            </select>                             <!--Se cambia el contenido del label con el scripSeleccion.js-->
            <input readonly placeholder="------ Seleccionar contrato ------" class="formulario_seccion" 
                    type="text" id="contrato_user" name="contrato_user"><br>
            <script src="js/scriptSeleccion.js"></script>

            <label>Titulo</label>
            <input class="formulario_seccion" required type="text" id="titulo_user" name="titulo_user"><br>
            <label>Email</label>
            <input class="formulario_seccion" required type="email" id="email_user" name="email_user"><br>
            <input class="boton" id="registro" required type="submit" value="Registrar" onclick="return confirmacion()">
        </form>

    </section>

    <script>
        /*Cuadro de confirmacion si deseas dar de alta al profesor*/
        function confirmacion(){
            var respuesta = confirm("¿Quieres dar de alta al profesor?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script>
        // Verifica si se ha establecido un mensaje de éxito en la sesión (después de procesar en PHP)
        <?php
        session_start();
        if (isset($_SESSION['mensaje'])) {
        ?>
        // Muestra un SweetAlert con el mensaje de la sesión
        Swal.fire({
            title: 'Mensaje',
            text: '<?php echo $_SESSION['mensaje']; ?>',
            icon: 'error'
        });
        <?php
        // Limpia la sesión
        unset($_SESSION['mensaje']);
        }
        ?>
    </script>

</body>
</html>
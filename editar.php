<?php
require_once "filePhp/conexionBD.php"; 
require_once "filePhp/metodosCRUD.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="hojasCSS/editarCSS.css" type="text/css">
</head>
<body>
    <?php
    if (isset($_POST['enviar'])) {

    } else {
        //Consulta paa llenar los campos del formulario.
        $c = new conexionBD();
        $conectar = $c-> conexion();

        $id = $_GET['id_trabajador']; //Id se obtiene desde la URL
        $sql = "SELECT * FROM trabajadores WHERE id_trabajador ='$id'";
        $resultado = mysqli_query($conectar, $sql);

        $fila = mysqli_fetch_assoc($resultado);

        $nombre = $fila['nombre'];                   $ap_paterno = $fila['ap_paterno'];
        $ap_materno = $fila['ap_materno'];           $fecha = $fila['fecha_ingreso'];
        $sexo = $fila['sexo'];                       $RFC = $fila['RFC'];
        $CURP = $fila['CURP'];                       $contrato = $fila['contrato'];
        $tipo_Trabajador = $fila['tipo_trabajador']; $horas_Total = $fila['total_Horas'];
        $status = $fila['Estatus'];                   $email = $fila['email'];
        $titulo = $fila['titulo'];                   $codigo_Tarjeta = $fila['codigo_tarjeta'];
        $imagen = $fila['foto'];
    ?>
    <!---------------------------------Encabezado---------------------------------------------->

    <header>
        <img id="logoTecnm" src="img/logoTECNMblanco.png">
        <label id="letrasITC">INSTITUTO TECNOLOGICO DE CANCUN</label>
        <img id="imagenITC" src="img/logoITC.png" /> 
    </header>

        <!---------------------------------Seccion---------------------------------------------->

    <section>

        <div id="imagenMain">
            <a href="menuAdmin.html"><img src="img/paginaPrincipal.png"><p>Pagina principal</p></a>
        </div>

        <form id="foto" method="post" action="filePhp/actualizarFoto.php" enctype="multipart/form-data"> <!--Actualizar foto del profesor-->
        <div class="img"> 
            <img style="border: 5px solid; border-color: #000;" src="data:image/jpg;base64,<?php echo base64_encode($imagen); ?>" alt="Foto">
            <br>				
            <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" style="display: none;">
            <button id="executeButton">Tomar foto</button>
        </div>

        </form>

        <form method="post" id="perfil" action="filePhp/actualizar.php" enctype="multipart/form-data"> <!--Actualizar informacion del profesor-->

            <div class="container">
                <h2 class="panel-title" style="text-align: center;"><i class='glyphicon glyphicon-user'></i>PERFIL</h2>

                <div class="lbl-menu">
                    <label for="radio1">Datos 1</label>
                    <label for="radio2">Datos 2</label>
                </div>

                <div class="content">
                    <input type="radio" name="radio" id="radio1" checked>
                    <div class="tab1">
                        <label>Numero:</label>
                        <input readonly type="text" class="formulario_seccion" name="txtNumero" value="<?php echo $id; ?>">
                    
                        <label>Nombre:</label>
                        <input type="text" class="formulario_seccion" name="txtNombre" value="<?php echo $nombre; ?>">
                                   
                        <label>Apellido paterno:</label>
                        <input type="text" class="formulario_seccion" name="txtApellidoP" value="<?php echo $ap_paterno; ?>">
                                      
                        <label>Apellido materno:</label>
                        <input type="text" class="formulario_seccion" name="txtApellidoM" value="<?php echo $ap_materno; ?>" >
                    
                        <label>Sexo:</label>
                        <select name="sexo" id="sexo" class="seleccion">
                            <option style="font-size: medium;">- - -</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select> 
                        <input type="text" readonly class="formulario_seccion" id="txtSexo" name="txtSexo" value="<?php echo $sexo; ?>">
                    
                        <label>RFC:</label>
                        <input type="text" class="formulario_seccion" name="txtRFC" value="<?php echo $RFC; ?>">
                    
                        <label>CURP:</label>
                        <input type="text" class="formulario_seccion" name="txtCURP" value="<?php echo $CURP; ?>">
                    
                        <label>Contrato:</label>
                        <select name="contrato" id="contrato" class="seleccion">
                            <option style="font-size: medium;">- - -</option>
                            <option value="Base">Base</option>
                            <option value="Por horas">Por horas</option>
                        </select> 
                        <input readonly type="text" class="formulario_seccion" id="contrato_user" name="contrato_user" value="<?php echo $contrato; ?>">
                                        
                        <button type="submit" name="enviar" class="btn btn-sm btn-success" onclick="return confirmacion()"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                 
                    </div>

                    <input type="radio" name="radio" id="radio2">
                    <div class="tab2">
                        
                        <label>Tipo de trabajador</label>
                        <select name="tipoTrabajador" id="tipoTrabajador" class="seleccion">
                            <option style="font-size: medium;">- - -</option>
                            <option value="Docente">Docente</option>
                            <option value="Administrativo">Administrativo</option>
                        </select> 
                        <input type="text" readonly class="formulario_seccion" id="txtTipoTrabajador" name="txtTipoTrabajador" value="<?php echo $tipo_Trabajador; ?>">
            
                        <label>Total Horas:</label>
                        <input type="number" class="formulario_seccion" name="txtHoras" value="<?php echo $horas_Total; ?>">
                        
                        <label>Status:</label>                        
                        <select name="Status" id="Status" class="seleccion">
                            <option style="font-size: medium;">- - -</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select> 
                        <input type="text" readonly class="formulario_seccion" id="txtStatus" name="txtStatus" value="<?php echo $status; ?>">             
                    
                        <label>Email</label>
                        <input type="email" class="formulario_seccion" name="txtEmail" value="<?php echo $email; ?>">
                                            
                        <label>Titulo</label>
                        <input type="text" class="formulario_seccion" name="txtTitulo" value="<?php echo $titulo; ?>">
                                     
                        <label>Codigo de tarjeta</label>
                        <input type="text" class="formulario_seccion" name="txtCodigoTarjeta" value="<?php echo $codigo_Tarjeta; ?>">
                           
                        <label>Fecha de ingreso</label>
                        <input type="date" class="formulario_seccion" name="txtFecha" value="<?php echo $fecha; ?>">

                        <button type="submit" name="enviar" class="btn btn-sm btn-success" id="botonActualizar"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                        <script src="js/confirmacion.js"></script>
                    </div>

                    <script src="js/scriptSeleccion.js"></script>  <!--====  Scrip para los etiquetas select  ====-->

                </div>
            
            </div>

        </form>

        <?php    
        }
        ?>

    </section>

    <script>
        document.getElementById("botonActualizar").onclick = function() {
        miFuncion(); // Reemplaza "miFuncion" con el nombre de tu función
    };
    </script>

        <!--====  End of html  ====-->

</body>
</html>
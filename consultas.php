<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="hojasCSS/consultaCSS.css" type="text/css">
</head>


<body>
    <!---------------------------------Encabezado---------------------------------------------->
    <header>
        <img id="logoTecnm" src="img/logoTECNMblanco.png">
        <label id="letrasITC">INSTITUTO TECNOLOGICO DE CANCUN</label>
        <img id="imagenITC" src="img/logoITC.png" /> 
    </header>

    <!---------------------------------Seccion---------------------------------------------->

    <div id="main">
        <a href="menuAdmin.html"><img src="img/paginaPrincipal.png"><p>Pagina principal</p></a>
        </div>

    <div class="container py-4 text-center">

            <h2>Empleados</h2>

            <div class="row g-4">

                <div class="col-5"></div>

                <div class="col-auto">
                    <label for="campo" class="col-form-label">Buscar: </label>
                </div>
                <div class="col-auto">
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>

            <div class="row py-4">
                <div class="col">
                    <!--Tabla de los registros-->
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th class="sort asc">Num. empleado</th>
                            <th class="sort asc">Nombre</th>
                            <th class="sort asc">RFC</th>
                            <th class="sort asc">Contrato</th>
                            <th class="sort asc">Titulo</th>
                            <th class="sort asc">Email</th>
                            <th></th>
                            <th></th>
                        </thead>

                        <!-- El id del cuerpo de la tabla. -->
                        <tbody id="content">

                        <!---La tabla se genera en el documento load.php-->

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

    <script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)

        function getData() {
            let input = document.getElementById("campo").value
            let content =document.getElementById("content")
            let url = "filePhp/load.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                }).catch(err => console.log(err))

        }
    </script>

    <script>
        /*Cuadro de confirmacion si desea eliminar al profesor*/
        function confirmacion(){
            var respuesta = confirm("¿Quieres dar de baja al profesor");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>
</html>
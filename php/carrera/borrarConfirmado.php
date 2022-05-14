<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Baja carrera</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            #contenedor{
                width: 60%;
                margin: auto;
                padding-top: 1em;
            }
            header{
                background-color: antiquewhite;
            }
            header h1{
                color:brown;
                font-size: 2.5em;
                padding: 10px 0;
            }
            a{
                display: block;
                padding: 10px 5px;
                background-color: red;
                text-decoration: none;
                font-size: 2em;
            }
            .botones{
                width: 60%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: center;
                position: absolute;
                  bottom: 10%;
            }
            .botones > button{
                width: 30%;
            }
        </style>
        <script>
           window.onload = inicio;
           function inicio(){
               escuchar();
           }
           function escuchar(){
               document.getElementById("nombre").addEventListener("blur", validarNombre);
               document.getElementById("duracion").addEventListener("blur", validarDuracion);
           }
           function validarNombre(){
               let campo = Document.getElementById("nombre");
               if(!campo.checkValidity()){
                  let mensaje = "El nombre insertado no es correcto, verifique.";
                  document.getElementById("panelInformativo").innerHTML = mensaje;
                  document.getElementById("panelInformativo").style.display = "block";
                  setTimeout(function (){
                    document.getElementById("panelInformativo").style.display = "none";
                    document.getElementById("panelInformativo").focus();
                  }, 5000);
               }
           }
           

        </script>
    </head>
    <body>
        <div id="contenedor">
            <header>
                <h1>Menú Academia</h1>
                <h2>Zona Carreras: Baja de carrera</h2>
                <hr />
            </header>
            <div id="formulario">
                <?php
                    //Captura de datos
                    $dato = $_GET["$carrera"];
                    //Establecer la conexión
                    include_once("./conexion.php");
                    //Crear un objeto bbdd
                    $baseDatos = new Conexion("academia");
                    //Tipos de fuente
                    mysqli_set_charset($conexion, "utf8");
                    //buscar el dato a borrar
                    $sql = "SELECT * FROM carreras";
                    $resultado = mysqli_query($conexion, $sql);
                    if($resultado){
                        $tubla = mysqli_fetch_row($resultado);
                        echo "<table><tr><th>ID carrera</th><th>Nombre carrera</th><th>Años de estudio</th></tr>";
                        echo "  <tr><td>" . $tupla[0] . "</td></tr>";
                        echo "  <tr><td>" . $tupla[1] . "</td></tr>";
                        echo "  <tr><td>" . $tupla[2] . "</td></tr>";
                        echo "</table>";

                        echo "<a href='./carreraBorrarConfirmado.com'>Borrar</a>";
                        echo "<a href='./carrerasMenu.html'>Salir sin borrar</a>"; 
                    }else{
                        echo "<p>No se ha encontrado la carrera, verifique</p>";
                    }
                ?>
            </div>
            <div class="botones">
                <button id="menuPrincipal">Volver al menú pricipal</button>
                <button id="menuCarrera">Volver al menú de carrera</button>
                <button id="nuevaCarrera">Nueva carrera</button>
            </div>
            <div id="panelInformativo"></div>
        </div>
    </body>
</html>

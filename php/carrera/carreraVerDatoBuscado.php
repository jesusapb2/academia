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
            table{
                width: 100%;
                margin: 10px 0;
            }
            table, td, th{
                border: 1px solid red;
                border-collapse: collapse;
            }
            td{
                padding-left: 10px;
            }
            a{
                display: block;
                padding: 10px 5px;
                margin-bottom: 5px;
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
                    $dato = $_GET["nombre"];
                    //Establecer la conexión
                    include_once("../conexion.php");
                    //Crear un objeto bbdd
                    $baseDatos = new Conexion("academia");
                    //Tipos de fuente
                    mysqli_set_charset($baseDatos->getConexion(), "utf8");
                    //buscar el dato a borrar
                    $sql = "SELECT * FROM carreras WHERE nombre = '$dato'";

                    $resultado = mysqli_query($baseDatos->getConexion(), $sql);
                    if($resultado){
                        echo "<table><tr><th>ID carrera</th><th>Nombre carrera</th><th>Años de estudio</th></tr>";
                        while($tupla = mysqli_fetch_row($resultado)){
                            echo "  <tr><td>" . $tupla[0] . "</td>";
                            echo "      <td>" . $tupla[1] . "</td>";
                            echo "      <td>" . $tupla[2] . "</td></tr>";
                        }
                        echo "</table>";
                        
                        $baseDatos->cerrarBBDD();
                    }else{
                        echo "<p>No se ha encontrado la carrera, verifique</p>";
                    }
                ?>
            </div>
            <div class="botones">
            <a href="../../webs/carrera/menuCarreras.html?mensaje=300"><button id="menuPrincipal">Volver al menú pricipal</button></a>
                <button id="menuCarrera">Volver al menú de carrera</button>
            </div>
            <div id="panelInformativo"></div>
        </div>
    </body>
</html>

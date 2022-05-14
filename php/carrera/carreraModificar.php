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
            .separador{
                height: 100px;
                width: 100%;
            }
            form{
                margin-top: 25px;
                width: 100%;
            }
            form label{
                display: block;
                margin-bottom: 5px;
            }
            form input[type="text"], form input[type="number"]{
                width: 100%;
                font-size: 1.5em;
            }
            form input[type="text"]:focus, form input[type="number"]:focus{
                background-color: beige;
            }
            form span{
                margin-left: 5px;
            }
            form div.separador:last-child{
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: center;
            }
            form div.separador:last-child > input{
                width: 40%;
            }
            span{
                opacity: 0;
                transition: 1s ease;
            }
            .validar:focus + span{
                opacity: 1; 
            }
        </style>
    </head>
    <body>
        <div id="contenedor">
            <header>
                <h1>Menú Academia</h1>
                <h2>Zona Carreras: Modificar carrera</h2>
                <hr />
            </header>
            <div id="formulario">
                <?php
                    $nombre = $_GET["nombre"];
                    //Establecer la conexión
                    include_once("../conexion.php");
                    //Crear un objeto bbdd
                    $baseDatos = new Conexion("academia");
                    //Tipos de fuente
                    mysqli_set_charset($baseDatos->getConexion(), "utf8");
                    //buscar el dato a borrar
                    $sql = "SELECT * FROM carreras";

                    $resultado = mysqli_query($baseDatos->getConexion(), $sql);
                    if($resultado){
                        echo "<form action='' method='get'>";
                        $tupla = mysqli_fetch_row($resultado);
                            echo "<div class='separador'>";                                
                                echo "<label for='id'>id carrera</label>";
                                echo "<input type='text' name='id' value='" . $tupla[0] . "' />";
                            echo "</div>";
                            echo "<div class='separador'>";
                                echo "<label for='nombre'>nombre</label>";
                                echo "<input type='text' name='nombre' value='" . $tupla[1] . "' />";
                            echo "</div>";
                            echo "<div class='separador'>";
                                echo "<label for='duracioon'>duración carrera</label>";
                                echo "<input type='text' name='duracion' value='" . $tupla[2] . "' />";
                            echo "</div>";

                        echo "<input type='submit' value'Enviar actualización' name='submit'/>";
                        echo "</form>";
                        
                    }else{
                        echo "<p>No se ha encontrado la carrera, verifique</p>";
                    }
                    if(isset($_GET["submit"])){
                        $id       = $_GET["id"];
                        $nombre   = $_GET["nombre"];
                        $duracion = $_GET["duracion"];

                        $sql = "UPDATE carreras SET nombre = '$nombre', duracion = '$duracion' WHERE id_carrera = '$id'";
                        $resultado = mysqli_query($baseDatos->getConexion(), $sql);
                        
                        $baseDatos->cerrarBBDD();
                        header("location:../../webs/carrera/menuCarreras.html?mensaje=400");
                    }
                ?>
            </div>

            <div class="botones">
                <button id="menuPrincipal">Volver al menú pricipal</button>
                <button id="menuCarrera">Volver al menú de carrera</button>
            </div>
            <div id="panelInformativo"></div>
        </div>
    </body>
</html>

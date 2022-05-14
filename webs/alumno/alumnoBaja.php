<!DOCTYPE html>
<html lang='es-ES'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>Baja alumno</title>
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
            .separador{
                height: 100px;
                width: 100%;
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
            #panelInformativo{
                position: absolute;
                     bottom: 2px;
                    left: 50%;
                transform: translate(-50%);
                background-color: rgba(255,0,0,0.5);
            }
            table{
                width: 100%:
            }
            table, td, th{
                border: 1px solid red;
                border_collapse: collapse;
            }
            table td img{
                width: 25%;
                height: auto;
                display: block;
            }
        </style>
    </head>
    <body>
        <div id='contenedor'>
            <header>
                <h1>Menú Academia</h1>
                <h2>Zona Alumno: baja de alumno/s</h2>
                <hr />
            </header>
            <div id='tabla'>
                <?php
                    include_once("../../php/conexion.php");
                    $conexion = new Conexion("academia");
                    $sql = "SELECT * FROM alumnos";
                    $resultado = mysqli_query($conexion->getConexion(), $sql);

                    if($resultado && mysqli_affected_rows($conexion->getConexion()) > 0){
                        echo '<table><tr>
                            <th>Nombre</th>
                            <th>apellido1</th>
                            <th>apellido2</th>
                            <th>Edad</th>
                            <th>Género</th>
                            <th>Carreraaa</th>
                            <th>foto</th>
                            <tr>Borrar</th>';

                        while($tupla = mysqli_fetch_row($resultado)){
                            echo "<tr>
                                <td><input class='validar' type='text' id='nombre' name='nombre'
                                required maxlength='30' minlength='2' 
                                spellcheck='true' value='$tupla[1]' /></td>
                                <td><input class='validar' type='text' id='apellido1' name='apellido1' 
                                required max='4' min='3' value= '$tupla[2]' /></td>
                                <td><input class='validar' type='text' id='apellido2' name='apellido2' 
                                required max='4' min='3' value = '$tupla[3]' /></td>
                                <td><input class='validar' type='number' id='edad' name='edad' 
                                required max='90' min='16' size='7' value='$tupla[4]' /></td>
                                <td><input class='validar' type='text' id='genero' name='genero' 
                                required maxlength='1' minlength='1' pattern=/[mf]/{1}/ value='$tupla[5]' size='6'>
                                <td><select name='carrera'>";
                                    $sql = 'SELECT id_carrera, nombre FROM carreras';
                                    $resultado1 = mysqli_query($conexion->getConexion(), $sql);
                                    if($resultado1){
                                        while($tupla1 = mysqli_fetch_row($resultado1)){
                                            echo "<option value='$tupla1[0]'>$tupla1[1]</option>";
                                        }
                                    }else{
                                        echo '<p>Ojo, no se ha ejecutado la consulta, verifique.</p>';
                                    };
                            echo "  </select>";
                            $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "htdocs/pooBBDD2022/ficherosAsociados" . $tupla[8];
                            echo "<tr><td><img src='$carpeta_destino' alt='Foto alumno ' />";
                            $direccion =  "../../php/alumno/bajaAlumno.php?id_alumno=$tupla[0]";
                            echo "</td><td><a href='$direccion'>borrar</a></td></tr>";
                        };
                        echo "</table>";
                    }else{
                        echo "<p>No hay datos de alumnos, la tabla está vacía.</p>";
                    }
                    echo "</table>";
                ?>
                <div class='botones'>
                    <button id='menuPrincipal'>Volver al menú pricipal</button>
                    <button id='menuCarrera'>Volver al menú de carrera</button>
                    <button id='nuevaCarrera'>Nueva carrera</button>
                </div>
                <div id='panelInformativo'></div>
            </div>    
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crud materias</title>
    <style>
        #contenedor{
            width: 90%;
            margin: auto;
        }
        table{
            width: 100%;
            margin: auto;
            margin-bottom: 20px;
        }
        table td{
            padding: 0 5px;
        }
        table, th, td{
            border: 1px solid red;
            border-collapse: collapse;
        }
        table td img{
            width: 15%;
            margin: auto;
            display: block;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["usuario"])){
            header("location:../../autenticar.html");
        }
    ?>
    <div id="contenedor">
        <header>
            <hgroup>
                <h1>Academia X</h1>
                <h2>Materias CRUD</h2>
            </hgroup>
        </header>
        <main>
            <h3>Tabla de materias...</h3>
            <table>
                <tr>
                    <th>Id materia</th>
                    <th>Nombre materia</th>
                    <th>Creditos</th>
                    <th>Años</th>
                    <th>Semestre</th>
                    <th>Id Carrera</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    include_once("../conexion.php");
                    $con = new Conexion("academia");

                    //-----Preparativos paginación
                    $porPag = 8;
                    if(!isset($_GET["pag"]) || $_GET["pag"] == 1){
                        $pag = 1;
                    }else{
                        $pag = $_GET["pag"];
                    }
                    $empezarDesde = ($pag-1)*$porPag;
                    $sql = "SELECT id_materia FROM materias";
                    $resultado = mysqli_query($con->getConexion(), $sql);
                    $regTotales = mysqli_num_rows($resultado);
                    $sql = "SELECT * FROM materias limit $empezarDesde, $porPag";
                    $resultado = mysqli_query($con->getConexion(), $sql);
                    $totalPaginas = ceil($regTotales / $porPag);
                    echo "<p> $pag de $totalPaginas</p>";
                    //--------------------------------------

                    if($resultado){
                        if(mysqli_num_rows($resultado)==0){
                            die("<p>La tabla está vacía.</p>");
                        }else if(!$resultado){
                            header("?mensaje=101");
                        }
                    }
                    foreach($resultado as $tupla) :?>
                        <tr><td><?php echo $tupla["id_materia"] ?></td>
                            <td><?php echo $tupla["nombre_materia"] ?></td>
                            <td><?php echo $tupla["creditos_materia"] ?></td>
                            <td><?php echo $tupla["anno"] ?></td>
                            <td><?php echo $tupla["semestre"] ?></td>
                            <td><?php echo $tupla["id_carrera2"] ?></td>
                            <td><img src="../../imagenes/<?php echo $tupla['foto'] ?>" alt="Sin foto" /></td>
                            <td>
                                <a href="./materiaBorrar.php?id_materia=<?php echo $tupla['id_materia'] ?>&materia=<?php echo $tupla['nombre_materia'] ?>"><button>Borrar</button></a>
                                <a href="./materiaModificar.php?id_materia=<?php echo $tupla['id_materia'] ?>"><button>Modificar</button></a>
                            </td>
                        </tr>
                    <?php endforeach; 
                        mysqli_close($con->getConexion());
                        mysqli_free_result($resultado);
                    ?>
               <form action="./materiaAlta.php" method="post" enctype="multipart/form-data">
                    <tr><td>&nbsp;</td>
                        <td><input type="text" name="nombre_materia" /></td>
                        <td><input type="text" name="creditos_materia" /></td>
                        <td><input type="text" name="anno" /></td>
                        <td><input type="text" name="semestre" /></td>
                        <td><input type="text" name="id_carrera2" /></td>
                        <td><input type="file" name="foto" /></td>
                        <td>
                            <input type="submit" value="Alta..." >
                        </td>
                    </tr>
               </form>
            </table>
            <?php
                //-----Paginación
                for($i=1;$i<=$totalPaginas;$i++){
                    if($i == $pag){
                        echo "<a style='background-color: rgba(255,0,0,0.5)' href='?pag=$i'>| $i | </a>";
                    }else{
                        echo "<a href='?pag=$i'>| $i | </a>";
                    }
                }
            ?>
            <div id="panelInformativo"></div>
        </main>
    </div>
</body>
</html>
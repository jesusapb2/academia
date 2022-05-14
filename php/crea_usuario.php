<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crea usuario</title>
</head>
<body>
    <div id="contenedor">
        <header>
            <h1>Menú Academia</h1>
            <h2>Crea usuario</h2>
            <hr />
        </header>
        <form action="" method="post">
            <label for="usuario">Inserte su nick o nombre:</label>
            <input type="text" id="usuario" name="usuario" />
            <label for="contrasenna">Insertar contraseña:</label>
            <input type="text" id="contrasenna" name="contrasenna" />
            <input type="submit" id="submit" name="submit" value="Crear usuario" />
            <input type="reset" id="reset" value="Borrar" />
        </form>
    </div>
    <?php
        if(isset($_POST["submit"])){
            //captura de datos
            $usu = htmlentities(addslashes($_POST["usuario"]));
            $con = $_POST["contrasenna"]; 
            
            //crear el usuario
            include("./conexion.php");
            $conexion = new Conexion("academia");
            mysqli_set_charset($conexion->getConexion(), "utf8");

            //encriptación
            //$usu = password_hash($usu, PASSWORD_DEFAULT, array("cost"=>10));
            $con = password_hash("1234", PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, contrasenna) VALUES('$usu', '$con')";
            try{
                $resultado = mysqli_query($conexion->getConexion(), $sql);
                if($resultado){
                    header("location:../index.php");
                }else{
                    echo "<p>No se ha podido dar de alta al usuario</p>";
                }
            }catch(Exception $e){
                echo "<p>Puede que el dato ya exista o bien se ha producido un error</p>";
                echo "<a href='../index.php'><buttom>Volver a index</buttom></a>";
            }
        }
    ?>
</body>
</html>

<?php
    $usu = htmlentities(addslashes(trim($_POST["usuario"])));
    $con = htmlentities(addslashes(trim($_POST["contrasenna"])));

    include("./conexion.php");
    $conexion = new Conexion("academia");
    mysqli_set_charset($conexion->getConexion(), "utf8");
    $sql = "SELECT usuario, contrasenna FROM usuarios WHERE usuario = '$usu'";
    $resultado = mysqli_query($conexion->getConexion(), $sql);
    
    if($resultado){
        $tupla = mysqli_fetch_row($resultado);
            echo "<p>" . $tupla[0] . "<p>";
            echo "<p>" . $tupla[1] . "<p>";
        if(password_verify($con, $tupla[1])){
            session_start();
            $_SESSION["usuario"] = $_POST["usuario"];
            header("location:../index.php");
        }else{
            echo "<p>El usuario no existe, verifique</p>";
            echo '<a href="../index.php"><buttom>Salir</buttom></a>';
        }
    }
?>


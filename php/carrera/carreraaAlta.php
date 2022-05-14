<?php
    $carrera  = $_GET["nombre"];
    $duracion = $_GET["duracion"];

    include_once("../conexion.php");

    //Crear un objeto bbdd
    $baseDatos = new Conexion("academia");

    //Tipos de fuente
    mysqli_set_charset($baseDatos->getConexion(), "utf8");

    //buscar el dato a borrar
    $sql = "INSERT INTO carreras (nombre, duracion) values ('$carrera', '$duracion')";
    $resultado = mysqli_query($baseDatos->getConexion(), $sql);
    if($resultado){
        header("location:/pooBBDD2022/webs/carrera/menuCarreras.html?mensaje=100");
    }else{
        header("location:/pooBBDD2022/webs/carrera/menuCarreras.html?mensaje=101");
    }

    //cerrar la base de datos
    $baseDatos->cerrarBBDD();
?>


<?php
    $carrera = $_GET["carrera"];
    include_once("../conexion.php");
    //Crear un objeto bbdd
    $baseDatos = new Conexion("academia");
    //Tipos de fuente
    mysqli_set_charset($baseDatos->getConexion(), "utf8");
    //buscar el dato a borrar
    $sql = "DELETE FROM carreras WHERE nombre = '$carrera'";
    $resultado = mysqli_query($baseDatos->getConexion(), $sql);
    if($resultado){
        header("location:../../webs/carrera/menuCarreras.html?mensaje=200");
    }else{
        header("location:../../webs/carrera/menuCarreras.html?mensaje=201");
    }
    $baseDatos->cerrarBBDD();
?>
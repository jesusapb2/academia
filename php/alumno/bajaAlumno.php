<?php
    $id_alumno = $_GET["id_alumno"];

    include_once("../conexion.php");
    $conexion = new Conexion("academia");
    
    $sql = "DELETE FROM ALUMNOS WHERE id_alumno = '$id_alumno'"; 
    
    $resultado = mysqli_query($conexion->getConexion(), $sql);
    if($resultado){
        header("location:../../webs/alumno/menuAlumno.html?mensaje=200");
    }else{
        header("location:../../webs/alumno/menuAlumno.html?mensaje=201");
    }
    $conexion->cerrarBBDD();
?>
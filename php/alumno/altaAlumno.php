<?php
    $nombre = $_GET["nombre"];
    $apell1 = $_GET["apellido1"];
    $apell2 = $_GET["apellido2"];
    $genero = $_GET["genero"];
    $edad   = $_GET["edad"];
    $id_car = $_GET["carrera"];    

    include_once("../conexion.php");
    $conexion = new Conexion("academia");
    
    $sql = "INSERT INTO alumnos (genero_alu, nombre_alu, apellido1_alu, apellido2_alu, edad_alu, id_carrera1) VALUES
            ('$genero', '$nombre', '$apell1', '$apell2', , '$edad', '$id_car')"; 
    
    $resultado = mysqli_query($conexion->getConexion(), $sql);
    if($resultado){
        header("location:../../webs/alumno/menuAlumno.html?mensaje=100");
    }else{
        header("location:../../webs/alumno/menuAlumno.html?mensaje=101");
    }
    $conexion->cerrarBBDD();
?>
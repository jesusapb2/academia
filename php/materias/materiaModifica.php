<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location:../../autenticar.html");
    }
?>
<?php
    echo "<p>modificando...</p>";
    $id_materia       = $_POST["id_materia"];
    $nombre_materia   = $_POST["nombre_materia"];
    $creditos_materia = $_POST["creditos_materia"];  
    $anno             = $_POST["anno"];
    $semestre         = $_POST["semestre"];
    $id_carrera2      = $_POST["id_carrera2"];
    $foto = $_FILES["foto"]["name"];
    /*** Tratar foto */
      
        $foto_nom = $_FILES["foto"]["name"];
        $foto_tam = $_FILES["foto"]["size"];
        $foto_tip = $_FILES["foto"]["type"];
        echo "fok... $foto_nom, $foto_tam, $foto_tip";
        /******** Guardar foto  */
            //raiz del servidor: htdocs
            $carp_gua = $_SERVER["DOCUMENT_ROOT"] . "/pooBBDD2022/imagenes/";
            /******** Zona temporal al destino */
            move_uploaded_file($_FILES["foto"]["tmp_name"], $carp_gua.$foto_nom);
        //*************** */
    }else{
        $foto_nom = $_POST["fotoActual"];
    }
    /*** */

    include_once("../conexion.php");
    $conexion = new Conexion("academia");
    $sql = "UPDATE materias SET nombre_materia = '$nombre_materia', 
                   creditos_materia = '$creditos_materia', 
                   anno = '$anno', semestre = '$semestre', 
                   id_carrera2 = '$id_carrera2', foto = '$foto_nom' 
            WHERE id_materia = '$id_materia'";
    $resultado = mysqli_query($conexion->getConexion(), $sql);
    if($resultado){
        mysqli_close($conexion->getConexion());
        echo "$foto_nom";
        //header("location:./materiasCrud.php?mensaje=400");
    }else{
        mysqli_close($conexion->getConexion());
        //header("location:./materiasCrud.php?mensaje=401");
    }
?>
<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location:../../autenticar.html");
    }
?>
<?php
    echo "<p>Estoy en la alta</p>";
    $nombre_materia = $_POST["nombre_materia"];
    $creditos_materia = $_POST["creditos_materia"];
    $anno = $_POST["anno"];
    $semestre = $_POST["semestre"];
    $id_carrera2 = $_POST["id_carrera2"];

    //******* la foto  */
    if($_FILES['foto']['error']!=4){ 
        $foto_nom = $_FILES["foto"]["name"];
        $foto_tam = $_FILES["foto"]["size"];
        $foto_tip = $_FILES["foto"]["type"];
    }else{
        $foto_nom = null;
    }
    
    /******** Filtrar */
    if(!empty($foto_tam)){
        if($foto_tam < 2000000){
            if($foto_tip == "image/gif" || $foto_tip == "image/jpg" || $foto_tip == "image/jpeg" || $foto_tip == "image/gif"){
                /******** Guardar foto  */
                //raiz del servidor: htdocs
                $carp_gua = $_SERVER["DOCUMENT_ROOT"] . "/pooBBDD2022/imagenes/";
                /******** Zona temporal al destino */
                move_uploaded_file($_FILES["foto"]["tmp_name"], $carp_gua.$foto_nom);
                //*************** */
            }else{
                header("location:./materiasCrud.php?mensaje=403");   
            }
        }else{
            header("location:./materiasCrud.php?mensaje=404");
        }
    }
    include_once("../conexion.php");
    $conexion = new Conexion("academia");
    $sql = "INSERT INTO materias (nombre_materia, creditos_materia, anno, semestre, id_carrera2, foto) 
            VALUES ('$nombre_materia', '$creditos_materia', '$anno', '$semestre', '$id_carrera2', '$foto_nom')";
    $resultado = mysqli_query($conexion->getConexion(), $sql);
    if($resultado){
        mysqli_close($conexion->getConexion());
        header("location:./materiasCrud.php?mensaje=200");
    }else{
        mysqli_close($conexion->getConexion());
        header("location:./materiasCrud.php?mensaje=201");
    }
?>
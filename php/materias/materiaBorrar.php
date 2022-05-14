<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location:../../autenticar.html");
    }
?>
<?php
    $id = $_GET["id_materia"];
    $ma = $_GET["materia"];
        
    http://localhost/pooBBDD2022/php/materias/materiaBorrar.php?submitSi=S%C3%AD
    echo "<h1>Borrar materia</h1>
          <label>¿Desea borrar la materia $ma?</label>
          <a href='?subSi=si&id_materia=$id&materia=$ma'><button>Sí</button></a>
          <a href='?subNo=no'><button>No</button></a>"; 
    
    if(isset($_GET["subSi"])=="si"){
        include_once("../conexion.php");
        $conexion = new Conexion("academia");
        $sql = "DELETE FROM materias WHERE id_materia = '$id'";
        $resultado = mysqli_query($conexion->getConexion(), $sql);
        if($resultado){
            mysqli_close($conexion->getConexion());
            header("location:./materiasCrud.php?mensaje=200");
        }else{
            mysqli_close($conexion->getConexion());
            header("location:./materiasCrud.php?mensaje=201");
        }
    }else if(isset($_GET["subNo"])){
        header("location:./materiasCrud.php?mensaje=202");
    }
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=º, initial-scale=1.0" />
    <title>alumno Consulta</title>
    <script>
        window.onload = iniciar;
        function iniciar(){
            document.getElementById("alumno").addEventListener("change", mostrarAlumno)
        }
        function creaXMLHttpRequest(){
            var xmlHTTP = null;
            //Dependiendo del navegador usado...
            if(window.activeXObject){
                //IE <= v6.0
                xmlHTTP = new ActiveXObject("Microsoft.XMLHTTP");
            }else{
                //IE > 6.0 Y NAVEGADORES NUEVOS 
                xmlHTTP = new XMLHttpRequest();
            }
            return xmlHTTP;
        }
        function mostrarAlumno(e){
            alert("valor: " + e.target.value);
            var xmlHttp;
            if(e.target.value == ""){
                document.getElementById("txtAjax") = "";
                return; 
            }
            xmlHttp = creaXMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
                if(xmlHttp.readyState == 4 &&  xmlHttp.status == 200){
                    document.getElementById("txtAjax").innerHTML = xmlHttp.responseText;
                }
            }
            
            xmlHttp.open("GET", "verConsultaAlumno.php?id=" + e.target.value, true);
            xmlHttp.send();
        }
    </script>
</head>
<body>
    <div id="contenedor">
        <header>
            <h1>Menú Academia</h1>
            <h2>Zona alumnos: consulta alumno</h2>
            <hr />
        </header>
        <div id="formulario">
            <form action="" method="post">
                <label for="">Seleccione un alumno:</label>
                <select name="alumno" id="alumno">
                <?php
                    include_once("../conexion.php");
                    //Crear un objeto bbdd
                    $baseDatos = new Conexion("academia");
                    //Tipos de fuente
                    mysqli_set_charset($baseDatos->getConexion(), "utf8");
                    //buscar el dato a borrar
                    $sql = "SELECT id_alumno, CONCAT(nombre_alu, ' ', apellido1_alu, ' ', apellido2_alu) AS nombre FROM alumnos";
                    $resultado = mysqli_query($baseDatos->getConexion(), $sql);
                    echo "<option value='0'>Seleccione un alumno...</option>";
                    if($resultado){
                        while($tupla = mysqli_fetch_assoc($resultado)){
                            echo "<option value='{$tupla['id_alumno']}'>{$tupla['nombre']}</option>";
                        }
                    }else{
                        echo "<p>Problemas a la hora de listar, verifique.</p>";
                    }
                    mysqli_free_result($resultado);
                    mysqli_close($baseDatos->getConexion());
                ?>
                </select>
                <input type="submit" value="Consultar alumno" name="submit" id="submit" />
            </form>
        </div>
        <div id="txtAjax"></div>
    </div>
</body>
</html>
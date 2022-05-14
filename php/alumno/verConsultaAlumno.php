<?php
    //crear el usuario
    include("../conexion.php");
    $conexion = new Conexion("academia");
    mysqli_set_charset($conexion->getConexion(), "utf8");
    $sql = "SELECT * FROM alumnos WHERE id_alumno = '$_GET[id]'";
    if($resultado = mysqli_query($conexion->getConexion(), $sql) and mysqli_num_rows($resultado) == 1){
        echo "<p>" . mysqli_num_rows($resultado) . "</P>";
        $tupla = mysqli_fetch_assoc($resultado);
        echo "<form>
            <div class='separador'>
                <label for='nombre'>Nombre del alumno:</label>
                <input type='' value='{$tupla['nombre_alu']}' />
            </div>
            <div class='separador'>
                <label for='apellido1'>Primer apellido del alumno:</label>
                <input type='' value='{$tupla['apellido1_alu']}' />
            </div>
            <div class='separador'>
                <label for='apellido2'>Segundo apellido del alumno:</label>
                <input type='' value='{$tupla['apellido2_alu']}' />
            </div>
            <div class='separador'>
                <label for='edad'>Edad del alumno:</label>
                <input type='number' value='{$tupla['edad_alu']}' />
            </div>
            <div class='separador'>
                <label for='genero'>Genero del alumno:</label>
                <input type='' value='{$tupla['genero_alu']}' /> 
            </div>
            <div class='separador'>
                <label for='anno'>Año del alumno:</label>
                <input type='' value='{$tupla['anno_alu']}' /> 
            </div>

            <div class='separador'>
                <label for='carrera'>Carrera solicitada por el alumno:</label>
                <input type='' value='{$tupla['id_carrera1']}' />
            </div>

            <div class='separador'>
                <input type='button' id='salir' value='Salir de consulta' />
            </div>
        </form>";
        echo "<script>alert('ok');</script>";
    }else{
        echo "<p>Se ha producido un error en ejecución, instrucción incorrecta o Servidor o BBDD no encontrada, verifique.</p>";
    }
?>
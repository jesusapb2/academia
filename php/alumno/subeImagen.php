<?php
    //caputura datos del fichero -0-
    $fichero_nombre  = $_FILES["fichero"]["name"];
    $fichero_tamanno = $_FILES["fichero"]["size"];

    //El uso de los tipos: lo que devuelve type
    /**
     * image/jepg 
     * image/
     * application/x-zip-compressed
     * 
     */
    //echo $_FILES["fichero"]["type"];
    $fichero_tipo    = $_FILES["fichero"]["type"];
    $fiC_dir_tem_ser = $_FILES["fichero"]["tmp_name"];
    $fichero_error   = $_FILES["fichero"]["error"];

    //Subir el fichero si se cumple una condición...  -1-
    if($fichero_tamanno <= 1000000){
        if($fichero_tipo == "image/jpeg" || $fichero_tipo == "image/jpg" || $fichero_tipo == "image/png"
           $fichero_tipo == "image/gif"){
            //indicamos en que carpeta del servidor dejamos los datos "carpeta destino"
            //DOCUMENT_ROOT es: /XAMPP/ -0-
            $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "htdocs/pooBBDD2022/ficherosAsociados";

            //Tenemos que mover el fichero de la carpeta temporal a su distino 
            //Junto con el nombre del fichero -0-
            move_uploaded_file($fiC_dir_tem_ser, $carpeta_destino . $fichero_nombre);
            //Falta subir el nombre del fichero al registro de un posible alumno.
            //Aviso de todo lo sucedido
            echo "<p>Fichero subido con éxito.</p>";
        }else{
            echo "<p>La extensión no es correcta, verifique que sea: JPEG, JPG, GIF o PNG</p>";
        }
    }else{
        echo "<P>El tamaño No cumple lo establecido, verifique que sea menor de 1MB.</p>";
    }
?>
<?php
    //declaro la cookie si no existe
    if(!isset($_COOKIE["cuenta"])){
        setcookie("cuenta", 1);
        echo "<p>Gracias por visitarnos por primera vez</p>";
    }else{
        echo "<p>Ya creada</p>";
        setcookie("cuenta", $_COOKIE["cuenta"]+1);
        echo "<p>Veces que ya nos visitas: " . $_COOKIE["cuenta"] . "</p>";
    }
    echo "<pre>";
        var_dump($_COOKIE);
    echo "</pre>";
    //borrar la cookie
    if(isset($_COOKIE["cuenta"])){
        if($_COOKIE["cuenta"] == 5){
            //Procede a borrar la cookie
            //unset($_COOKIE["cuenta"]);
            setcookie("cuenta", "", time() - 1);
        }
    }
?>
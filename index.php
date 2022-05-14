<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Menú principal</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            #contenedor{
                width: 60%;
                margin: auto;
                padding-top: 1em;
            }
            header{
                background-color: antiquewhite;
            }
            header h1{
                color:brown;
                font-size: 2.5em;
                padding: 10px 0;
            }
            .zonaMenu{
                margin-top: 1em;
                display: grid;
            	grid-template-columns: repeat(2, 1fr);
	            grid-template-rows: repeat(3, 100px);
	            grid-gap: 1em;
            }
            .zonaMenu a{
                display: block;
                width: 100%;
                padding: 40px 0;
                background-color: antiquewhite;
                text-align: center;
                font-size: 2em;
            }
        </style>
    </head>
    <body>
        <?php
           session_start();
           if(!isset($_SESSION["usuario"])){
               header("location:./autenticar.html");
           } 
        ?>
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
        <div id="contenedor">
            <header>
                <h1>Menú Academia</h1>
                <hr />
            </header>
            <div class="zonaMenu">
                <a href="./webs/alumno/menuAlumno.html">Menú Alumnos</a>
                <a href="./webs/carrera/menuCarreras.html">Menú Carreras</a>    
                <a href="./php/materias/materiasCrud.php">Materias</a>            
            </div>
        </div>
    </body>
</html>
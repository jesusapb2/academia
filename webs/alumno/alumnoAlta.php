<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Alta alumno</title>
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
            .separador{
                height: 100px;
                width: 100%;
            }
            form{
                margin-top: 25px;
                width: 100%;
            }
            form label{
                display: block;
                margin-bottom: 5px;
            }
            form input[type="text"], form input[type="number"]{
                width: 100%;
                font-size: 1.5em;
            }
            form input[type="text"]:focus, form input[type="number"]:focus{
                background-color: beige;
            }
            form span{
                margin-left: 5px;
            }
            form div.separador:last-child{
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: center;
            }
            form div.separador:last-child > input{
                width: 40%;
            }
            span{
                opacity: 0;
                transition: 1s ease;
            }
            .validar:focus + span{
                opacity: 1; 
            }
            .botones{
                width: 60%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: center;
                position: absolute;
                  bottom: 10%;
            }
            .botones > button{
                width: 30%;
            }
            #panelInformativo{
                position: absolute;
                     bottom: 2px;
                    left: 50%;
                transform: translate(-50%);
                background-color: rgba(255,0,0,0.5);
            }
        </style>
        <script>
            window.onload = inicio;
            function inicio(){
               escuchar();
            }
            function escuchar(){
                let computar = document.querySelectorAll(".validar");
                for(let i=0; i<computar.length; i++){
                    computar[i].addEventListener("blur", validar);
                }
            }
            function validar(e){
                let mensajes = "";
                let campo = e.target.id;
                
                switch(campo){
                    case "nombre": 
                    case "apellido1": 
                    case "apellido2":
                                                
                        if(!e.target.checkValidity()){
                            mensajes += "\nEl " + campo + " es incorrecto, verifique.";
                            e.target.focus();
                        }
                        break;
                    case "edad":
                        if(!e.target.checkValidity()){
                            mensajes += "\nEl " + campo + " es incorrecto, verifique.";
                            e.target.focus();
                        }
                        break;
                    case "genero":
                        if(!e.target.checkValidity()){
                            mensajes += "\nEl " + campo + " es incorrecto, verifique, solo: m ó f.";
                            e.target.focus();
                        }
                        break;
                    case "submit": 
                        if(mensajes != ""){
                            return true;
                        }else{
                            mensajes += "Intento de enviar formulario incorrecto, verifique";
                            e.preventDefault();
                        }
                }
                if(mensajes != ""){
                    document.getElementById("panelInformativo").innerHTML = mensajes; 
                    document.getElementById("panelInformativo").style.display = "block";
                    //evito poner hasta la palabra function...
                    setTimeout(() => {
                        document.getElementById("panelInformativo").style.display = "none";
                    }, 5000);
                }
            }
                      
        </script>
    </head>
    <body>
        <div id="contenedor">
            <header>
                <h1>Menú Academia</h1>
                <h2>Zona Carreras: Alta de carrera</h2>
                <hr />
            </header>
            <div id="formulario">
                <form action="../../php/alumno/altaAlumno.php" method="get">
                    <div class="separador">
                        <label for="nombre">Nombre del alumno:</label>
                        <input class="validar" type="text" id="nombre" name="nombre"
                               required maxlength="30" minlength="2" 
                               spellcheck="true"  />
                        <span>Nombre del alumno, es obligatorio.</span>
                    </div>
                    <div class="separador">
                        <label for="apellido1">Primer apellido del alumno:</label>
                        <input class="validar" type="text" id="apellido1" name="apellido1" 
                               required max="4" min="3" />
                        <span>Primer apellido, es obligatorio.</span>
                    </div>
                    <div class="separador">
                        <label for="apellido2">Segundo apellido del alumno:</label>
                        <input class="validar" type="text" id="apellido2" name="apellido2" 
                               required max="4" min="3" />
                        <span>Segundo apellido, no es obligatorio.</span>
                    </div>
                    <div class="separador">
                        <label for="edad">Edad del alumno:</label>
                        <input class="validar" type="number" id="edad" name="edad" 
                               required max="90" min="16" />
                        <span>La edad es obligatoria.</span>
                    </div>
                    <div class="separador">
                        <label for="genero">Genero del alumno:</label>
                        <input class="validar" type="text" id="genero" name="genero" 
                               required maxlength="1" minlength="1" pattern=/[mf]/{1}/>
                        <span>El género es obligatorio.</span>
                    </div>
                    <div class="separador">
                        <label for="carrera">Carrera solicitada por el alumno:</label>
                        <select name="carrera">
                            <?php
                                include_once("../../php/conexion.php");
                                $conectaBBDD = new Conexion("academia");
                                $sql = "SELECT id_carrera, nombre FROM carreras";
                                $resultado = mysqli_query($conectaBBDD->getConexion(), $sql);
                                if($resultado){
                                    while($tupla = mysqli_fetch_row($resultado)){
                                        echo "<option value='$tupla[0]'>$tupla[1]</option>";
                                    }
                                }else{
                                    echo "<p>Ojo, no se ha ejecutado la consulta, verifique.</p>";
                                }
                            ?>
                        </select>
                        <span>La carrera es obligatoria.</span>
                    </div>

                    <div class="separador">
                        <input class="validar" type="submit" id="submit" name="submit" value="Alta alumno" />
                        <input type="reset"  value="Borrar el formulario" />                        
                    </div>
                </form>
                <form action="subeImagen.php" method="post" enctype="multipart/form-data" >
                    <label for="fichero">Seleccione un fichero:</label>
                    <input type="file" id="fichero" name="fichero" size="20" />
                    <input type="submit" id="submit" name="submit" value="Enviar" />
                </form>
              </div>
            <div class="botones">
                <button id="menuPrincipal">Volver al menú pricipal</button>
                <button id="menuCarrera">Volver al menú de carrera</button>
                <button id="nuevaCarrera">Nueva carrera</button>
            </div>
            <div id="panelInformativo"></div>
        </div>
    </body>
</html>
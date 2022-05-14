<?php
    class Conexion{
        private $serv;
        private $user;
        private $cont;
        private $bbdd;
        private $cone;

        function __construct($bbdd){
            $this->serv = "localhost";
            $this->user = "root";
            $this->cont = "";
            $this->bbdd = $bbdd;
            $this->conectar();
        }

        function conectar(){
            $estableceConexion = mysqli_connect($this->serv, $this->user, $this->cont);
            if(mysqli_connect_errno()){
                echo "<p>Error 1: Conexión no establecida, verifique.</p>";
                echo "Error 2: No se pudo conectar a MySQL." . PHP_EOL;
                echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
                exit();
            }
            mysqli_select_db($estableceConexion, $this->bbdd) or die("Error 2: No se puede entrar a la BBDD");
            echo "<p>Conexión completada</p>";
            $this->cone =  $estableceConexion;
        }

        function cerrarBBDD(){
            mysqli_close($this->cone);
        }
        function getConexion(){
            return $this->cone;
        }
    }
?>


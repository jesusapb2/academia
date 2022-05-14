<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        class Per{
            var $nombre;
            function __construct($nom){
                $this->nombre = "jesus";
            }
        }
        $per1 = new Per("Jesús");
        echo "<p>Hola " . $per1->nombre . "</p>";
    ?>
</body>
</html>
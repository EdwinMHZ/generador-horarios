<?php
$user = "root";
$pass = "";
$host = "localhost";

$connection = mysqli_connect($host, $user, $pass);

if(!$connection) 
{            
    echo "No se ha podido conectar con el servidor" . mysql_error();
}

$datab = "materias_prueba";
$db = mysqli_select_db($connection,$datab);
if (!$db)
{
echo "No se ha podido encontrar la base de datos";
}

?>
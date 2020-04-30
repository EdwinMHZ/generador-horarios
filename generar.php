<?php
include "conexion.php";


$consulta="select nombre from Temporal";
$result = mysqli_query($connection,$consulta);
if(!$result) 
{
    echo "No se ha podido realizar la consulta en temporal";
}
$num_materias = $result->num_rows;
$claves=[$num_materias];
$i=0;
while ($colum = mysqli_fetch_array($result))
{
    $materia=$colum['nombre'];
    $consulta="select clave from Materia where nombre='$materia'";
    $resultado=mysqli_query($connection,$consulta);
    if(!$resultado){
        echo "No se ha podido realizar la consulta";
    }else{
        while ($colum = mysqli_fetch_array($resultado))
        {
            $clave=$colum['clave'];
            $claves[$i]=$clave;
            $i++;
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generador de Horarios</title>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>
<body>
    
</body>
</html>
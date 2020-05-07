<?php
    include "conexion.php";

    $id=$_POST["id"];
    $consulta="delete from Horarios where Id_Horario='".$id."'";
    $resultado = mysqli_query($connection,$consulta);
    if(!$resultado) 
    {
        echo "No se ha podido eliminar el horario";
    }else{
        echo "Se ha eliminado el horario correctamente";
    }
?>
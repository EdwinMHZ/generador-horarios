<?php
include "conexion.php";

    $accion=$_POST["accion"];
    $materia=$_POST["materia"];
    //echo "$materia";
    if($accion==0){
        $consulta="select * from temporal where nombre='$materia'";
        $resultado = mysqli_query($connection,$consulta);
        $columnas = mysqli_num_rows($resultado);
        
        if($columnas>=1){
            echo "Esta materia ya ha sido agregada";
        }else{
            $consulta="insert into temporal (nombre) values('$materia')";
            $result = mysqli_query($connection,$consulta);
            if(!$resultado) 
            {
                echo "No se ha podido realizar la consulta";
                echo "\n$materia";
            }else{
                //echo "$result";
                echo "\n$materia ha sido agregada";

            }
        }
    }else{
        //echo "PROBANDO";
        $consulta="delete from temporal where nombre='$materia'";
        $resultado = mysqli_query($connection,$consulta);
        if(!$resultado){
            echo "No se ha podido realizar la consulta";
        }else{
            echo "$materia eliminada";
        }

    }
    
    
?>
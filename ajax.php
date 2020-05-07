<?php
include "conexion.php";
    $boleta="2014170767";
    $accion=$_POST["accion"];
    $materia=$_POST["materia"];
    //echo "$materia";
    if($accion==0){
        $consulta="select * from Temporal where Materia='$materia' and Alumno='".$boleta."'";
        $resultado = mysqli_query($connection,$consulta);
        $columnas = mysqli_num_rows($resultado);
        
        if($columnas>=1){
            echo "Esta materia ya ha sido agregada";
        }else{
            $consulta="insert into Temporal (Alumno,Materia) values('$boleta','$materia')";
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
        $consulta="delete from Temporal where Materia='$materia' and Alumno='".$boleta."'";
        $resultado = mysqli_query($connection,$consulta);
        if(!$resultado){
            echo "No se ha podido realizar la consulta";
        }else{
            echo "$materia eliminada";
        }

    }
    
    
?>
<?php
include "conexion.php";
    $boleta="2014170767";
    $accion=$_POST["accion"];
    $materia=$_POST["materia"];
    //echo "$materia";
    if($accion==0){
        
        $consulta="select Clave from Materia where Nombre='". $materia."'";
        $resultado=mysqli_query($connection,$consulta);
        if(!$resultado){
            echo "No se encontro una clave para esta materia";
        }else{
            $columna=mysqli_fetch_array($resultado);
            $clave=$columna[0];
            //echo "clave:".$clave;
            $consulta="select * from Temporal where Materia_Clave='$clave' and Alumno_Boleta='".$boleta."'";
            $resultado = mysqli_query($connection,$consulta);
            $columnas = mysqli_num_rows($resultado);

            if($columnas>=1){
                echo "Esta materia ya ha sido agregada";
            }else{
                $consulta="insert into Temporal (Materia_Clave,Alumno_Boleta) values('$clave','$boleta')";
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
        }
    }else{
        //echo "PROBANDO";
        $consulta="select Clave from Materia where Nombre='".$materia."'";
        $resultado=mysqli_query($connection,$consulta);
        if(!$resultado){
            echo "No se encontro la clave de la materia ".$materia;
        }else{
            $columna=mysqli_fetch_array($resultado);
            $clave=$columna[0];
            $consulta="delete from Temporal where Materia_Clave='$clave' and Alumno_Boleta='".$boleta."'";
            $resultado = mysqli_query($connection,$consulta);
            if(!$resultado){
                echo "No se ha podido realizar la consulta";
            }else{
                echo "$materia eliminada";
            }
        }

    }
    
    
?>
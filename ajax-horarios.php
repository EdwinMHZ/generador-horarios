<?php
include "conexion.php";
    $boleta="2014170767";
    $horario=$_POST["horario"];
    $id=$_POST["id"];
    echo $id;
    $consulta="select * from Horarios where Id_Horario='". $id."'";
    $resultado = mysqli_query($connection,$consulta);
    $columnas = mysqli_num_rows($resultado);
    
    if($columnas>=1){
        echo "Ya se ha agregado este horario";
    }else{
        
        $consulta="insert into Horarios (Id_Horario,Alumno) values ('".$id."','". $boleta ."')";
        $result = mysqli_query($connection,$consulta);
        if(!$result) 
        {
            echo "No se ha podido realizar la consulta Horarios";
        }else{
            //echo "$result";
            foreach($horario as $m){
                $consulta2="insert into Horarios_Materia(Id_Horario,Clave_Materia,Grupo) values('". $id."','".$m[0] ."','".$m[1] ."')";
                $resultado = mysqli_query($connection,$consulta2);
                if(!$resultado) 
                {
                    echo "No se ha podido realizar la consulta Horarios_Materia";
                }
            }
            echo "\nHorario agregado";
        }
        
            
    }
    
    
?>
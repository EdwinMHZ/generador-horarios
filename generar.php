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
    <div class="contenedor">
        <h2>Horarios Generados</h2>
        <h6>Se han encontrado horarios de acuerdo a los criterios seleccionados</h6>
        <?php

            $num_horarios=3;
            for ($i=0; $i < $num_horarios; $i++) { 
                echo "<h4>Horario" . ($i+1) . "</h4>";
                //echo "<div class='horarios'>";//div class horarios
                echo "<div class='tabla_horario'>";//div class tabla_horario
                echo "<table>";
                echo "<tr>";
                    echo "<th>Grupo</th>";
                    echo "<th>Asignatura</th>";
                    echo "<th>Profesor</th>";
                    echo "<th>LUN</th>";
                    echo "<th>MAR</th>";
                    echo "<th>MIE</th>";
                    echo "<th>JUE</th>";
                    echo "<th>VIE</th>";
                echo "</tr>";
                for ($j=0; $j <$num_materias ; $j++) { 
                    echo "<tr>";
                        echo "<td>1CV6</td>";
                        echo "<td>DESARROLLO DE SISTEMAS DISTRIBUIDOS</td>";
                        echo "<td>UKRANIO CORONILLA CONTRERAS</td>";
                        echo "<td>10:30-12:00</td>";
                        echo "<td>8:30-10:00</td>";
                        echo "<td>8:30-10:00</td>";
                        echo "<td>10:30-12:00</td>";
                        echo "<td>8:30-10:00</td>";
                    echo "<tr>";
                }
                echo "</table>";
                echo "</div>";//div class tabla_horario
                echo "<div class='btn_guardar'>";
                echo "<button  onclick='guardarHorario(0,". "\"$materia\""  .")'>Guardar Horario</button>";            
                echo "</div>";
                //echo "</div>";//div class horarios
            }
        ?>
    </div>
</body>
</html>
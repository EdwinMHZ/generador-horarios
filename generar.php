<?php
include "conexion.php";
require "Genetico.php";
$boleta="2014170767";
$consulta="select * from Temporal where Alumno='".$boleta."'";
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
    $materia=$colum['Materia'];
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

$genetico = new Genetico($claves);
$horarios = $genetico->getHorarios();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generador de Horarios</title>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>
<body>
    <div class="header">
        <img src="img/logo-ipn.png" alt="logo-ipn">
        <h2>ESCUELA SUPERIOR DE CÓMPUTO</h2>
        <img src="img/logo-escom.png" alt="logo-escom">
    </div>
    <div class="contenedor">
        <div class="izquierda">
            <h4>Alumno</h4>
            <h5>EDWIN JAVIER MORALES HERNÁDEZ</h5>
            <h4>Boleta</h4>
            <h5>2014170767</h5>
        </div>
        <div class="centro">
        <h2>Horarios Generados</h2>
        <h6>Se han encontrado horarios de acuerdo a los criterios seleccionados</h6>
        <?php
            foreach ($horarios as $i => $horario ) { 
                $id=[];
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
                $dia_hora=[5];
                for ($j=0; $j < 5; $j++) { 
                    $dia_hora[$j]="";
                }
                foreach ($horario as $m) {
                    $id[$m[0]]=$m[1];
                    echo "<tr>";
                        echo "<td>".$m[1]."</td>";
                        $consulta="select nombre from Materia where clave='".$m[0]."'";
                        $result = mysqli_query($connection,$consulta);
                        if(!$result) 
                        {
                            echo "No se ha podido realizar la consulta en Materia";
                        }
                        else{
                            while ($colum = mysqli_fetch_array($result))
                            {
                                $nombre=$colum['nombre'];
                                echo "<td>$nombre</td>";
                            }
                        }
                        echo "<td>UKRANIO CORONILLA CONTRERAS</td>";
                        $consulta="select * from Clases where Materia_clave='".$m[0]."' and Grupo='".$m[1]."'";
                        $result = mysqli_query($connection,$consulta);
                        if(!$result) 
                        {
                            echo "No se ha podido realizar la consulta en clases";
                        }
                        else{
                            while ($colum = mysqli_fetch_array($result))
                            {
                                $dia=$colum['Dia'];
                                $hora=$colum['Hora'];
                                if ($dia == "Lun") {
                                    $dia_hora[0]=$hora;
                                }
                                elseif ($dia == "Mar") {
                                    $dia_hora[1]=$hora;
                                }
                                elseif ($dia == "Mie") {
                                    $dia_hora[2]=$hora;
                                }
                                elseif ($dia == "Jue") {
                                    $dia_hora[3]=$hora;
                                }
                                else {
                                    $dia_hora[4]=$hora;
                                }
                            }
                        }
                        for ($k=0; $k < 5; $k++) { 
                            echo "<td>".$dia_hora[$k]."</td>";
                            $dia_hora[$k]="";
                        }
                    echo "</tr>";
                }
                $identificador="";
                krsort($id);
                foreach ($id as $key => $val) {
                    //echo "$key = $val\n";
                    $identificador .= $key . $val;
                }
                //echo $identificador;
                echo "</table>";
                echo "</div>";//div class tabla_horario
                echo "<div class='btn_guardar'>";
                echo "<button  onclick='guardarHorario(". json_encode($horario)  .",". "\"$identificador\""  .")'>Guardar Horario</button>";            
                echo "</div>";
                
            }
        ?>
        </div>
        <div class="acceso-rapido">
            <h4>Acceso Rápido</h4>
            <ul>       
                <li><a href="index.php">Horarios de Clase</a></li>
                <li><a href="horarios.php">Horarios Guardados</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
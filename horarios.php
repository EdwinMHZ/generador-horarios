<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Guardados</title>
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
            <h3>Horarios Guardados</h3>
            <h4>Selecciona el horario que deseas inscribir</h4>
            <form action="#" method="POST" id="seleccion_horarios">
                <?php
                    include "conexion.php";
                    $dia_hora=[5];
                    for ($i=0; $i < 5; $i++) { 
                        $dia_hora[$i]="";
                    }
                    $consulta="select * from Horarios";
                    $resultado = mysqli_query($connection,$consulta);
                    $num_horarios = mysqli_num_rows($resultado);
                    $contador=0;
                    $ids=[$num_horarios];
                    while ($colum = mysqli_fetch_array($resultado)){
                        $ids[$contador]=$colum["Id_Horario"];
                        $contador++;
                    }


                    for ($i=0; $i <$num_horarios ; $i++) { 
                        echo "<input type='radio' id='horario". $i ."' name='horarios' value='$i'>";
                        echo "<label for='horario". $i ."'>Horario ". ($i+1) . "</label><br>";

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
                        $consulta1="select * from Horarios_Materia where Id_Horario='". $ids[$i]. "'";
                        $result1 = mysqli_query($connection,$consulta1);
                        if(!$result1) 
                        {
                            echo "No se ha podido realizar la consulta en horariosmaterias";
                        }
                        else{
                            while ($colum = mysqli_fetch_array($result1))
                            {
                                $clave=$colum['Clave_Materia'];
                                $grupo=$colum['Grupo'];
                                echo "<tr>";
                                echo "<td>$grupo</td>";
                                $consulta="select nombre from Materia where clave='$clave'";
                                $result = mysqli_query($connection,$consulta);
                                if(!$result) 
                                {
                                    echo "No se ha podido realizar la consulta en temporal";
                                }
                                else{
                                    while ($colum = mysqli_fetch_array($result))
                                    {
                                        $nombre=$colum['nombre'];
                                        echo "<td>$nombre</td>";
                                    }
                                }
                                echo "<td>OLGA KOLESNIKOVA</td>";
                                $consulta="select * from Clases where Materia_Clave='$clave' and Grupo='$grupo'";
                                $result = mysqli_query($connection,$consulta);
                                if(!$result) 
                                {
                                    echo "No se ha podido realizar la consulta en temporal";
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
                        }
                        echo "</table>";
                        echo "</div>";//div class tabla_horario
                        echo "<div class='btn_eliminarH'>";
                        echo "<form action=\"\" id='form-eliminar'>";
                        echo "<input type='button'  onclick='eliminarHorario("."\"$ids[$i]\"".")' value='Eliminar Horario' id='btneliminarH' form='form-eliminar'>";            
                        echo "</form>";
                        echo "</div>";
                    }
                ?>
                
                <div class="notficaciones">
                    <div class="check_notificaciones">
                        <input type="checkbox" id="envia_notificaciones" name="notificaciones" value="1">
                        <label for="envia_notificaciones"> Enviarme notificaciones sobre ocupabilidad de horario</label><br>
                    </div>
                    
                </div>
                <div class="boton_inscribir">
                        <input type="submit" value="Inscribir Horario" id="btn_inscribir" form="seleccion_horarios">
                </div>
            </form>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Guardados</title>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>
<body>
    <div class="contenedor">
        <h3>Horarios Guardados</h3>
        <h4>Selecciona el horario que deseas inscribir</h4>
        <form action="#" method="POST">
        <?php

            $num_horarios=3;
            $num_materias=6;
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
                echo "<div class='btn_eliminarH'>";
                echo "<button  onclick='quitarHorario(0,". "\"$i\""  .")'>Eliminar Horario</button>";            
                echo "</div>";
            }
        ?>
        <div class="notficaciones">
            <div class="check_notificaciones">
                <input type="checkbox" id="envia_notificaciones" name="notificaciones" value="1">
                <label for="envia_notificaciones"> Enviarme notificaciones sobre ocupabilidad de horario</label><br>
            </div>
            <div class="btn_inscribirH">
                <input type="submit" value="Inscribir Horario" id="btn_inscribir">
            <div>
        </div>
        </form>
    </div>
</body>
</html>
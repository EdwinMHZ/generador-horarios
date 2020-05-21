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
        <h2>Horarios de Clase</h2>
            <div class="criterios">
                <p>Seleccione criterios de visualización</p>
                <form action="" method="POST">
                    <label for="carreras">Carrera</label>
                    <select id="carreras">
                        <option value="ciencia_datos">Licenciatura en Ciencia de Datos</option>
                        <option value="inteligencia">Ingeniería en Inteligencia Artificial</option>
                        <option value="isc" selected>Ingeniería en Sistemas Computacionles</option>
                    </select>
                    <div class="turnos">
                        <label for="turnos">Turno</label>
                        <select id="turnos">
                            <option value="matutino">Matutino</option>
                            <option value="vespertino">Vespertino</option>
                        </select>
                    </div>
                    <div class="periodo">
                        <p>Seleccione el periodo</p>
                        <div>
                            <input type="radio" id="p_actual" name="periodo" value="actual" checked>
                            <label for="p_actual">Periodo Actual</label>
                          </div>

                          <div>
                            <input type="radio" id="p_proximo" name="periodo" value="proximo">
                            <label for="p_proximo">Próximo Periodo</label>
                          </div>
                    </div>
                    <div class="linea">
                        <div class="plan">
                            <label for="plan">Plan de Estudios</label>
                            <select id="plan">
                                <option value="plan2009" selected>Plan del 2009</option>
                                <option value="plan2020">Plan del 2020</option>
                            </select>
                        </div>
                        <div class="periodo">
                            <label for="nivel">Periodo</label>
                            <select id="nivel" name="nivel">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="btn_visualizar">
                            <input type="submit" value="Visualizar" id="btn_visualizar" name="enviar-nivel">
                        </div>
                    </div>
                </form>
                <div class="horarios">
                    <form action="" method="POST">
                     <?php
                        include "conexion.php";
                        $boleta="2014170767";
                        if(isset($_POST["enviar-nivel"]))
                            $nivel=$_POST["nivel"];
                        else    
                            $nivel=1;
                        echo "<h2>Unidades de aprendizaje del nivel $nivel</h2>";
                        $consulta="select nombre from Materia where Periodo=$nivel";
                        $result = mysqli_query($connection,$consulta);
                        if(!$result) 
                        {
                            echo "No se ha podido realizar la consulta";
                        }
                        echo "<table>";
                        while ($colum = mysqli_fetch_array($result))
                        {
                           $materia=$colum['nombre'];
                           echo "<tr>";
                           echo "<td><input type='button' class='btn_agregar' onclick='agregarMateria(0,". "\"$materia\""  .")'/></td>";
                           echo "<td><h5>" . $materia . "</td></h5>";
                           echo "</tr>";
                        }                  
                    
                        echo "</table>";

                    ?>
                    </form>
                </div>
                <div class="horarios">
                <?php
                    include "conexion.php";
                    $num_materias=0;
                    $consulta="select * from Temporal where Alumno_Boleta='".$boleta."'";
                    $result = mysqli_query($connection,$consulta);
                    if(!$result) 
                    {
                        echo "No se ha podido realizar la consulta";
                    }
                    echo "<h2>Unidades de aprendizaje seleccionadas</h2>";
                    echo "<table>";
                    while ($colum = mysqli_fetch_array($result))
                    {
                        $clave=$colum['Materia_Clave'];
                        $consulta="select Nombre from Materia where Clave='".$clave."'";
                        $resultado=mysqli_query($connection,$consulta);
                        if(!$resultado){
                            echo "No se encontro la materia";
                        }else{
                            $columna=mysqli_fetch_array($resultado);
                            $materia=$columna[0];
                            echo "<tr>";
                            echo "<td><input type='button' class='btn_quitar' onclick='agregarMateria(1,". "\"$materia\""  .")'/></td>";
                            echo "<td><h5>" . $materia . "</td></h5>";
                            echo "</tr>";
                            $num_materias++;
                        }
                    }                  
                
                    echo "</table>";
                
                    ?>
                </div>

            </div>
            <div class="form_generar">
                <form action="generar.php">
                    <input type="submit" class="btn_generar" value="Generar Horarios">
                </form>
                
            </div>
            
        </div>
        <div class="acceso-rapido">
            <h4>Acceso Rápido</h4>
             <ul>       
                <li><a href="index.php">Horarios de Clase</a></li>
                <li><a href="horarios.php">Horarios Guardados</a></li>
            </ul>
        <div>
        
    </div>
    
</body>
</html>
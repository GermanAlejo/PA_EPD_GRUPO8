<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-P3</title>
    </head>
    <body>

        <?php

        function devolverCarrera($carreras, $nombre, $fechaBuscada) {

            $i = 0;
            $encontrado = false;
            $carrera = "";

            while (!$encontrado && $i < count($carreras)) {

                if ((strcasecmp($nombre, $carreras[$i][0]) == 0) && (strtotime($fechaBuscada) == strtotime($carreras[$i][1]))) {
                    $encontrado = true;
                    $carrera = $carreras[$i];
                }

                $i++;
            }



            return $carrera;
        }
        
        function mostrarCarreras($numCarreras, $carreras){
            
            for($i=0;$i<$numCarreras;$i++){
                mostrarCarrera($carreras[$i]);
            }
        }
        
        function ganadorGT($numCarreras, $carreras){
            
            for($i=0;$i<$numCarreras;$i++){
                getVencedor($carreras[$i]);
            }
        }

        function mostrarCarrera($carrera) {

            echo "<br>Carrera: " . $carrera[0] . " En la fecha: " . $carrera[1] . "<br>";

            $sizeX = count($carrera);
            $sizeY = count($carrera[2]);
            for ($j = 1; $j < $sizeY; $j++) {

                for ($i = 2; $i < $sizeX; $i++) {
                    echo $j . "; &nbsp;&nbsp;&nbsp;&nbsp;" . $carrera[$i][0] . "; &nbsp;&nbsp;&nbsp;&nbsp;" . $carrera[$i][$j] . "<br>";
                }
            }
        }

        function calculaTiempo($tArray) {

            $min = $tArray[0] * 60;
            $sec = $min + $tArray[1];
            $micS = $tArray[2] + ($sec * 1000);

            return $micS;
        }

        function getVueltaRapida($carrera) {

            $tiempo = 0;
            $bestT = 0;
            $numVuelta = 1;
            $bestP = "";
            $vuelta = "";

            for ($i = 2; $i < count($carrera); $i++) {
                $piloto = $carrera[$i];
                for ($j = 1; $j < count($piloto); $j++) {
                    if ($piloto[$j] == "::") {
                        $tiempo = 0;
                    } else {
                        $tArray = explode(':', $piloto[$j]);
                        $tiempo = calculaTiempo($tArray);
                    }
                    if ($tiempo < $bestT || $bestT == 0) {
                        $bestT = $tiempo;
                        $bestP = $piloto[0];
                        $numVuelta = $j;
                        $vuelta = $piloto[$j];
                    }
                }
            }

            echo "<br>";
            echo "<table>VUELTA MAS RAPIDA DEL GP
                <tr><th>Nombre del Piloto</th>
                    <th>Vuelta Nº </th>
                    <th>Tiempo Total</th>
                </tr>
                <tr>
                    <td>" . $bestP . "</td>
                    <td>" . $numVuelta . "</td>
                    <td>" . $vuelta . "</td
            </table>";
        }

        function calcularTiempoTotal($tiempo) {
            $milli = $tiempo % 1000;
            $seconds = ($tiempo / 1000) % 60;
            $minutes = ($tiempo / (1000 * 60)) % 60;

            return $minutes . ":" . $seconds . ":" . $milli;
        }

        function getVencedor($carrera) {

            $nomVencedor = "";
            $bestTiempo = 0;
            $tiempo = 0;

            for ($i = 2; $i < count($carrera); $i++) {
                $piloto = $carrera[$i];
                for ($j = 1; $j < count($piloto); $j++) {
                    $tArray = explode(':', $piloto[$j]);
                    $tiempo += calculaTiempo($tArray);
                }

                if ($tiempo < $bestTiempo || $bestTiempo == 0) {
                    $nomVencedor = $piloto[0];
                    $bestTiempo = $tiempo;
                }
            }

            $bestTiempo = calcularTiempoTotal($bestTiempo);

            echo "<br>";
            echo "<table>VENCEDOR DEL GP 
                <tr><th>Nombre vencedor</th>
                    <th>Tiempo Total</th>
                </tr>
                <tr>
                    <td>" . $nomVencedor . "</td>
                    <td>" . $bestTiempo . "</td
            </table>";
        }

        function arrayToBidim($equipos) {

            $newEquipos;

            for ($i = 0; $i < count($equipos); $i++) {
                $newEquipos[$i / 2][$i % 2] = $equipos[$i];
            }
            return $newEquipos;
        }

        function getEquipoVencedor($equipos, $carrera) {

            $c = 0;
            $tiempo = 0;
            $pilotos = array(); //array de pilotos y su tiempo total

            for ($i = 2; $i < count($carrera); $i++) {

                $piloto = $carrera[$i]; //piloto con todos sus tiempos
                //print_r($carrera);
                // print_r($piloto);
                //echo "<br>";
                $pilotos[$c] = $piloto[0];
                for ($j = 1; $j < count($piloto); $j++) {

                    $tArray = explode(':', $piloto[$j]);
                    $tiempo += calculaTiempo($tArray);
                }
                //echo $tiempo . " ";
                $pilotos[$c + 1] = $tiempo;
                $c+=2;
            }
            //print_r($pilotos);
            $tEquipos = array(); //array de equipos con tiempo por equipo
            $terminado = false;
            $c = 0;

            for ($i = 0; $i < count($equipos); $i++) {
                $equipo = $equipos[$i]; //array del equipo y pilotos
                $nomEquipo = $equipo[0]; //nombre de equipo
                $tEquipo = 0; //tiempo del equipo

                while (!$terminado && $c < count($pilotos) / 2) {
                    if ($pilotos[$c] == $equipo[1] || $pilotos[$c] == $equipo[2]) {
                        $tEquipo += $pilotos[$c + 1];
                    }
                    $c++;
                }
                //echo $nomEquipo . " tiempo " . $tEquipo;
                $tEquipos[] = $nomEquipo;
                $tEquipos[] = $tEquipo;
                $c = 0;
            }

            $tEquipos = arrayToBidim($tEquipos);

            array_multisort($tEquipos[0], SORT_DESC, $tEquipos[1], SORT_DESC);
            //echo "<br>";
            //print_r($tEquipos);

            mostrarEquipos($tEquipos);
        }

        function mostrarEquipos($tEquipos) {
            //print_r($tEquipos[1][0]);

            echo "<br>";
            echo "<table>EQUIPOS DEL GP ";
            echo"<tr><th>Nombre Equipo</th>
                    <th>Tiempo Total</th>";
            for ($i = 0; $i < count($tEquipos); $i++) {
                echo '<tr><td>' . $tEquipos[$i][1] . '</td>';
                $tEquipos[$i][0] = calcularTiempoTotal($tEquipos[$i][0]);
                echo '<td>' . $tEquipos[$i][0] . '</td></tr>';
            }
        }
        ?>


        <form action = "index.php" method = "post">
            <fieldset><legend>Formulario Carrera Campeonato</legend>
            Carreras del GT<input name ="gt" type="texte"/>
            
            </fieldset>
            <fieldset><legend>Formulario Carreras</legend>
                Equipo <input name ="equipo" type="text"/> <br>
                <select name ="carrera">
                    <option value="Jerez">Jerez</option>
                    <option value="Motegi">Motegi</option>
                </select>
                <select name="fecha">
                    <option value="19/10/2018">19/10/2018</option>
                    <option value="20/5/2018">20/5/2018</option>
                </select>
                <fieldset><legend>Tipo vuelta</legend><br> <label><input name = "rapida" type = "checkbox" value ="rapida"/> Vuelta Rapida<br> </label>
                    <label><input name = "vencedor" type ="checkbox" value="vencedor"/> Vencedor<br /></label></fieldset>
                <label><input type = "submit" type ="button" value="Enviar"/></label>
            </fieldset>
        </form>
        <?php
        $carreras = array(
            array("Jerez", date('19/10/2018'),
                array("Pedrosa", '3:11:32', '3:02:55', '2:22:01', '3:00:00', '3:12:31'),
                array("Rossi", '3:20:50', '1:56:11', '4:55:33', '2:11:11', '2:11:32'),
                array("Lorenzo", '2:00:20', '2:45:44', '2:43:10', '4:54:11', '2:22:22'),
                array("Dovicioso", '2:00:00', '2:20:45', '3:00:10', '4:05:20', '2:40:50')),
            array("Motegi", date('20/5/2018'),
                array("Pedrosa", '3:20:50', '1:56:11', '4:55:33', '2:11:11', '2:11:32'),
                array("Rossi", '3:11:32', '3:02:55', '2:22:01', '3:00:00', '3:12:31'),
                array("Lorenzo", '3:10:20', '2:20:44', '1:55:45', '2:54:11', '4:05:10'),
                array("Dovicioso", '1:55:10', '2:30:32', '2:20:10', '3:10:00', '2:10:40')),
            array("Motegi", date('1/5/2017'),
                array("Pedrosa", '3:20:50', '1:56:11', '4:55:33', '2:11:11', '2:11:32'),
                array("Rossi", '3:11:32', '3:02:55', '2:22:01', '3:00:00', '3:12:31'),
                array("Lorenzo", '3:10:20', '2:20:44', '1:55:45', '2:54:11', '4:05:10'),
                array("Dovicioso", '1:55:10', '2:30:32', '2:20:10', '3:10:00', '2:10:40'))
        );

        $equipos = array(
            array("Ducati", "Rossi", "Dovicioso"),
            array("Honda", "Pedrosa", "Lorenzo")
        );

        $fecha = $_POST['fecha'];

        $numCarreras = $_POST['gt'];
        $nombreCarrera = $_POST['carrera'];
        $fechaBuscada = strtotime($fecha);

        $rapida = $_POST['rapida'];
        $vencedor = $_POST['vencedor'];

        $carrera = devolverCarrera($carreras, $nombreCarrera, $fechaBuscada);
        if ($carrera == "") {
            echo "La carrera no ha sido encontrada o la fecha es incorrecta";
        }
        
        mostrarCarreras($numCarreras, $carreras);
        ganadorGT($numCarreras, $carreras);
//$carrera = $carreras[0];
        mostrarCarrera($carrera);
        if (strcasecmp($vencedor, "vencedor") == 0) {
            //imprime vencedor
            getVencedor($carrera);
        }
        if (strcasecmp($rapida, "rapida") == 0) {
            //imprime la mejor vuelta
            getVueltaRapida($carrera);
        }

//print_r($equipos);
        getEquipoVencedor($equipos, $carrera)
        ?>


    </body>
</html>

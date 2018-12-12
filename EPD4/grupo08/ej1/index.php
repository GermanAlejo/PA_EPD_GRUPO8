<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-Ej2</title>
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
        ?>


        <form action = "index.php" method = "post">
            <fieldset><legend>Formulario Carreras</legend>
            Carrera <input name = "carrera" type = "text"/> <br>
            Fecha de la Carrera <label><input name = "fecha" type = "date"/> </label><br /> 
                <fieldset><legend>Tipo vuelta</legend><br> <label><input name = "radio" type = "radio" value ="rapida"/> Vuelta Rapida<br> </label>
                <label><input name = "radio" type ="radio" value="vencedor"/> Vencedor<br /></label></fieldset>
            <label><input type = "submit" type ="button" value="Enviar"/></label>
            </fieldset>
        </form>
        <?php
        $carreras = array(
            array("Jerez", date('19/10/2018'),
                array("Pedrosa", '3:11:32', '3:02:55', '2:22:01', '3:00:00', '3:12:31'),
                array("Rossi", '3:20:50', '1:56:11', '4:55:33', '2:11:11', '2:11:32'),
                array("Lorenzo", '2:00:20', '2:45:44', '2:43:10', '4:54:11', '2:22:22')),
            array("Motegi", date('20/5/2018'),
                array("Pedrosa", '3:20:50', '1:56:11', '4:55:33', '2:11:11', '2:11:32'),
                array("Rossi", '3:11:32', '3:02:55', '2:22:01', '3:00:00', '3:12:31'),
                array("Lorenzo", '3:10:20', '2:20:44', '1:55:45', '2:54:11', '4:05:10'))
        );

        $nombreCarrera = $_POST['carrera'];
        $fechaBuscada = date('d/m/Y', strtotime($_POST['fecha']));
        $tipoAccion = $_POST['radio'];

        $carrera = devolverCarrera($carreras, $nombreCarrera, $fechaBuscada);
        if ($carrera == "") {
            echo "La carrera no ha sido encontrada o la fecha es incorrecta";
        }


        mostrarCarrera($carrera);
        if (strcasecmp($tipoAccion, "vencedor") == 0) {
            //imprime vencedor
            getVencedor($carrera);
        }
        else if (strcasecmp($tipoAccion, "rapida") == 0) {
            //imprime la mejor vuelta
            getVueltaRapida($carrera);
        }else{
            echo "Selecciona una opcion";
        }
        ?>


    </body>
</html>

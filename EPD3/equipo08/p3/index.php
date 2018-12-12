<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $trayecto = array(
            array("Sevilla", "Dos Hermanas", "Los Palacios", "Las Cabezas", "Lebrija", "Trebujena", "Sanlucar", "Rota"),
            array(0, 14.1, 31.5, 57.3, 73.4, 85.2, 108, 130)
        );
        $lugar = array("Lebrija", 0,
            array(" "));

        function eligeLugar($lugar, $trayecto) {
            $size = count($trayecto[0]);
            //echo "size :" . $size . "<br>";
            $encontrado = 0;
            for ($i = 0; $i < $size; $i++) {
                if ($encontrado == 1) {
                    array_push($lugar[2], $trayecto[0][$i]);
                }
                if ($lugar[0] == $trayecto[0][$i] and $encontrado == 0) {
                    //strcmp($lugar[0], $trayecto[0][$i]) and $encontrado == 0) {
                    $lugar[1] = $trayecto[1][$size - 1] - $trayecto[1][$i];
                    $encontrado = 1;
                }
            }
            if ($encontrado == 0) {
                echo 'No se ha encontrado la ciudad Hulio :' . "<br>";
            }
            return $lugar;
        }

        $lugarFin = eligeLugar($lugar, $trayecto);
        $trayectoFin = $lugarFin[2];
        $size = count($trayectoFin);
        //echo "size :" . $size . "<br>";
        echo " EL pueblo es :" . $lugarFin[0] . "<br>" . " La distancia que queda :" . $lugarFin[1] . "<br>";
        for ($i = 0; $i < $size; $i++) {
            echo $trayectoFin[$i] . "<br>";
        }
        ?>
    </body>
</html>

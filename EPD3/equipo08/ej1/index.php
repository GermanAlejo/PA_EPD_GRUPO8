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
        $MAXIMO = 108;
        $chance = 0.2;
        $Sevilla[0] = 94.8;
        $Malaga[0] = 99.4;
        $Cordoba[0] = 99.5;
        $size = (int) (($MAXIMO - $Sevilla[0]) / $chance);
        for ($i = 0; $i < $size; $i++) {
            $Sevilla[$i + 1] = $Sevilla[$i] + $chance;
        }
        $size = (int) (($MAXIMO - $Malaga[0]) / $chance);
        for ($i = 0; $i < $size; $i++) {
            $Malaga[$i + 1] = $Malaga[$i] + $chance;
        }
        $size = (int) (($MAXIMO - $Cordoba[0]) / $chance);
        for ($i = 0; $i < $size; $i++) {
            $Cordoba[$i + 1] = $Cordoba[$i] + $chance;
        }

        echo 'Frecuencias Sevilla:';
        print_r($Sevilla);
        echo "<br>";
        echo 'Frecuencias Sevilla:';
        print_r($Malaga);
        echo "<br>";
        echo 'Frecuencias Sevilla:';
        print_r($Cordoba);
        echo "<br>";
        ?>
        
    </body>
</html>

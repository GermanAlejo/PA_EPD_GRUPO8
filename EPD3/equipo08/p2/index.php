<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD3_P2</title>
    </head>
    <body>
        <?php

       /* function listarPrestadores($listaPrestadores) {

            for ($i = 0; $i < sizeof($listaPrestadores[$i]); $i++) {
                for ($j = 0; $j < sizeof($listaPrestadores[$i][$j]); $j++) {
                    echo "Prestador Nº" . ($i + 1) . "-> " . $listaPrestadores[$i][$j] . " " . $listaPrestadores[$i][$j + 1] . " "
                    . $listaPrestadores[$i][$j + 2] . " " . $listaPrestadores[$i][$j + 3] . " <br>";
                }
            }
        }*/
        
        
        
        $provincias = array("SEVILLA", "CADIZ");

        $listaPrestadores = array(
            array(
                array("2002356S", "PepeSur S.L", "FM", "Sevilla"),
                array("3242128C", "Ruperto II Fernandez", "TDT Autonomica", "Gelves")
            )
            , array(
                array("1233456F", "Alfronsio S.L", "TDT Local", "Rota"),
            )
        );
        



        
        for ($k = 0; $k <= sizeof($listaPrestadores[$k]); $k++) {
           
            echo "<table style= 'width:50%'>
            <thead>
                <tr>
                    REGISTRO DE PRESTADORES DE LA COMUNICACIÓN AUDIOVISUAL PROVINCIA: " . $provincias[$k] .
               " </tr>
                <tr>
                    <td>DNI|CIF</td>
                    <td>Denominacion</td>
                    <td>Tipo de Licencia</td>
                    <td>Poblacion</td>
                </tr>
            </thead>

            <tbody>";
            for ($i = 0; $i < sizeof($listaPrestadores[$k][$i]); $i++) {
                echo "<tr>";
                for ($j = 0; $j < sizeof($listaPrestadores[$k][$i][$j]); $j++) {
                    echo "<td>" . $listaPrestadores[$k][$i][$j] . "</td><td>" . $listaPrestadores[$k][$i][$j + 1] . "</td><td>"
                    . $listaPrestadores[$k][$i][$j + 2] . "</td><td>" . $listaPrestadores[$k][$i][$j + 3] . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody> </table>";
        }
        ?>

</body>
</html>

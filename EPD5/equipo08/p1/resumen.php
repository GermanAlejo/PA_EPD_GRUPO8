<?php

@include 'cabecera.php';

if (isset($_POST['enviar1'])) {
    $codAero = explode('-', $_POST['aerolinea_radio'])[0];
    $nomAero = explode('-', $_POST['aerolinea_radio'])[1];

    echo "<h1>$nomAero</h1>";

    $matriz = ordenaPorNumeroVuelos(vuelosPorAerolinea_Origen($codAero));
    
    echo '<table>';
    echo '<tr><th>Origen de vuelo</th><th>Nº de vuelos</th><th>Tiempo medio</th></tr>';
    foreach ($matriz as $v){
        echo '<tr>';
            echo '<td>' . $v[0] . '</td>';
            echo '<td>' . $v[1] . '</td>';
            $tiempoMedio = $v[2]/$v[1];
            echo '<td>' . intval($tiempoMedio/60) . 'h ' . $tiempoMedio%60 . 'm </td>';
        echo '</tr>';
    }
    echo '</table>';
}

if (!isset($_POST['enviar1'])) {
    echo '<h1>Aerolineas: </h1>';
    $aerolineas = leeArchivoCsv('aerolineas.csv');
    echo '<form action="resumen.php" method="POST">';
    foreach ($aerolineas as $aero) {
        echo '<input type="radio" name="aerolinea_radio" value="' . $aero[0] . '-' . $aero[1] . '">' . $aero[1] . '  ';
        echo '<br>';
    }
    echo '<input type="submit" name="enviar1" value="Siguiente">';
    echo '</form>';
}

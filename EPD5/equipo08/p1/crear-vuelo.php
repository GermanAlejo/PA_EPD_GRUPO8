<?php
@include 'cabecera.php';

if (isset($_POST['enviar2'])) {
    escribeVuelo();
    echo '<h1 style="color:green">Vuelo registrado!</h1>';
}

if (isset($_POST['enviar1'])) {
    $nomOri = explode("-", $_POST['destino_radio'])[0];
    $codAero = explode("-", $_POST['destino_radio'])[1];
    $destinos = destinosPorAerlinea($codAero);

    $destinos = array_diff($destinos, destinosUsadosPorAerlineaYOrigen($codAero, $nomOri));

    if (sizeof($destinos) < 1) {
        $error_no_destinos_posibles = TRUE;
    } else {
        echo "<h1>Origen</h1>";
        echo '<h3>' . $nomOri . '</h3>';
        echo '<h1>Destino</h1>';

        echo '<form action="crear-vuelo.php" method="POST">';

        echo '<select name="destino">';
        foreach ($destinos as $dest) {
            echo '<option value="' . $dest . '">' . $dest . '</option>';
        }
        echo '</select>';
        echo '<p>Hora del vuelo: <input type="time" name="duracion"></p>';
        echo '<br><br>';
        echo '<input type="hidden" name="idAero" value="' . $codAero . '">';
        echo '<input type="hidden" name="origen" value="' . $nomOri . '">';
        echo '<input type="submit" name="enviar2" value="Siguiente">';
        echo '</form>';
    }
}

if ((!isset($_POST['enviar1']) && !isset($_POST['enviar2'])) || isset($error_no_destinos_posibles)) {
    if (isset($error_no_destinos_posibles)) {
        echo '<p style="color:red">No hay destinos posibles con esta configuración, elija otro</p>';
    }
    echo '<h1>Origen del Vuelo</h1>';
    $aerolineas = leeArchivoCsv('aerolineas.csv');
    $destinos = leeArchivoCsv('destinos.csv');
    echo '<form action="crear-vuelo.php" method="POST">';
    foreach ($aerolineas as $aero) {
        echo "<h2>$aero[1]</h2>";
        foreach ($destinos as $dest) {
            if ($aero[0] == $dest[0]) {
                echo '<input type="radio" name="destino_radio" value="' . $dest[1] . '-' . $aero[0] . '">' . $dest[1] . '  ';
            }
        }
    }
    echo '<br><br>';
    echo '<input type="submit" name="enviar1" value="Siguiente">';
    echo '</form>';
}

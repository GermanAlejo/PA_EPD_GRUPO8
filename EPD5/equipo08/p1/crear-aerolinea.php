<?php

@include 'cabecera.php';

if (isset($_POST['env_destinos'])) {
    $destinos = array();
    $i = 0;
    $rep = array();

    while ($i < $_POST['num_dest']) {
        $destinos[] = $_POST['ciu' . $i];
        $i++;
    }

    $rep = array_count_values($destinos);

    foreach ($rep as $v => $k) {
        if ($k > 1) {
            $error_multiple = TRUE;
        }
    }

    if (!isset($error_multiple)) {

        escribeAerolinea();
        escribeDestinos();

        echo '<h1 style="color:green">Aerolinea registrada!</h1>';
    }
}

if (isset($_POST['env_nom_aero']) || isset($error_multiple)) {
    $aerolineas = leeArchivoCsv("aerolineas.csv");
    $i = 0;

    while ($i < sizeof($aerolineas)) {
        if ($aerolineas[$i][1] == $_POST['nom_aero']) {
            $aerolineaRepetida = TRUE;
        }
        $i++;
    }

    $ciudades = leeCiudades();
    $nCiudades = count($ciudades);

    if (($_POST['num_dest'] > 0 && $nCiudades <= $_POST['num_dest']) || isset($aerolineaRepetida)) {
        if (!isset($aerolineaRepetida)) {
            $error_num = TRUE;
        }
    } else {

        if (isset($error_multiple)) {
            echo '<h2 style="color:red">No puede haber ciudades repetidas</h2>';
        }
        echo '<form method="POST">';
        for ($i = 0; $i < $_POST['num_dest']; $i++) {
            echo '<p>Ciudad ' . $i . ': <select name="' . "ciu$i" . '">';
            foreach ($ciudades as $v) {
                echo '<option value="' . $v . '">' . $v . '</option>';
            }
            echo '</select></p>';
        }

        echo '<input type="hidden" value="' . $_POST['nom_aero'] . '" name="nom_aero">';
        echo '<input type="hidden" value="' . $_POST['num_dest'] . '" name="num_dest">';
        echo '<input type="submit" name="env_destinos" value="Siguiente">';
        echo '</form>';
    }
}

if ((!isset($_POST['env_nom_aero']) && !isset($_POST['env_destinos'])) || isset($error_num) || isset($aerolineaRepetida)) {

    if (isset($error_num)) {
        echo '<h2 style="color : red">Error en n&uacute;mero de destinos</h2>';
        echo '<ul style="color:red"><li>Sólo n&uacute;meros</li><li>S&oacute;lo hay ' . sizeof(leeCiudades()) . ' ciudades de destino</li></ul>';
    } else if (isset($aerolineaRepetida)) {
        echo '<h2 style="color : red">Error, aerolinea ya existente!</h2>';
    }
    echo '<form method="POST">';
    echo '<p>Nombre Aerol&iacute;nea: <input type="text" name="nom_aero"></p>';
    echo '<p>N&uacute;mero de destinos: <input type="text" name="num_dest"></p>';
    echo '<p><input type="submit" name="env_nom_aero" value="Siguiente"></p>';
    echo '</form>';
}

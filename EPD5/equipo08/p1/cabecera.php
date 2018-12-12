<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php

        function escribeAerolinea() {
            $num = sizeof(leeArchivoCsv('aerolineas.csv')) + 1;
            $fichero = fopen("aerolineas.csv", 'a');
            flock($fichero, LOCK_EX);
            fwrite($fichero, $num . ';' . $_POST['nom_aero'] . "\n");
            flock($fichero, LOCK_UN);
            fclose($fichero);
            return $num;
        }

        function escribeDestinos() {
            $num = sizeof(leeArchivoCsv('aerolineas.csv'));
            $fichero = fopen("destinos.csv", 'a');
            flock($fichero, LOCK_EX);
            $i = 0;
            while (isset($_POST["ciu$i"])) {
                fwrite($fichero, $num . ';' . $_POST["ciu$i"] . "\n");
                $i++;
            }

            flock($fichero, LOCK_UN);
            fclose($fichero);
        }

        function leeCiudades() {
            $fichero = fopen("ciudades.csv", 'r');
            flock($fichero, LOCK_SH);
            $linea = fgets($fichero);
            $ciudades = explode(",", $linea);
            flock($fichero, LOCK_UN);
            fclose($fichero);

            return $ciudades;
        }

        function leeArchivoCsv($fichero) {
            $datos = array();
            $fichero = fopen($fichero, 'r');
            flock($fichero, LOCK_SH);

            $linea = fgets($fichero);
            while ($linea != NULL) {
                $datos[] = explode(";", $linea);
                $linea = fgets($fichero);
            }

            for ($i = 0; $i < sizeof($datos); $i++) {
                for ($j = 0; $j < sizeof($datos[$i]); $j++) {
                    $datos[$i][$j] = str_replace("\n", '', $datos[$i][$j]);
                }
            }

            flock($fichero, LOCK_UN);
            fclose($fichero);
            return $datos;
        }

        function destinosPorAerlinea($codAero) {
            $data = array();
            $destinos = leeArchivoCsv('destinos.csv');

            foreach ($destinos as $v) {
                if ($v[0] == $codAero) {
                    $data[] = $v[1];
                }
            }
            return $data;
        }

        function destinosUsadosPorAerlineaYOrigen($codAero, $ciuOri) {
            $data = array();
            $destinos = leeArchivoCsv('vuelos.csv');

            foreach ($destinos as $v) {

                if (($v[0] == $codAero) && ($v[1] == $ciuOri)) {
                    $data[] = $v[2];
                }
            }
            $data[] = $ciuOri;

            return $data;
        }

        function escribeVuelo() {
            $v = fopen("vuelos.csv", 'a');
            flock($v, LOCK_EX);
            $aero = $_POST['idAero'];
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $duracion = $_POST['duracion'];
            $salida = $aero . ';' . $origen . ';' . $destino . ';' . $duracion . "\n";
            fwrite($v, $salida);
            flock($v, LOCK_UN);
            fclose($v);
        }

        function vuelosPorAerolinea_Origen($codAero) {
            $allVuelos = leeArchivoCsv('vuelos.csv');
            $salida = array();
            for ($i = 0; $i < sizeof($allVuelos); $i++) {
                if ($allVuelos[$i][0] == $codAero) {
                    $nomOrig = $allVuelos[$i][1];
                    $nomDest = $allVuelos[$i][2];
                    $dur = toMinutes($allVuelos[$i][3]);
                    $salida[$nomOrig][] = [$nomDest, $dur];
                }
            }

            $tratado = array();
            $i = 0;

            foreach ($salida as $k => $v) {
                $tratado[$i][0] = $k;
                $tratado[$i][1] = sizeof($v);
                $tratado[$i][2] = 0;
                foreach ($v as $h) {
                    $tratado[$i][2] += $h[1];
                }
                $i++;
            }
            return $tratado;
        }

        function toMinutes($time) {
            $salida = intval((explode(':', $time)[0])) * 60;
            $salida += intval(explode(':', $time)[1]);
            return $salida;
        }

        function ordenaPorNumeroVuelos($matriz) {
            for ($i = 0; $i < sizeof($matriz); $i++) {
                for ($j = $i; $j < sizeof($matriz); $j++) {
                    if ($matriz[$i][1] < $matriz[$j][1]) {
                        $aux = $matriz[$i];
                        $matriz[$i] = $matriz[$j];
                        $matriz[$j] = $aux;
                    }
                }
            }
            return $matriz;
        }
        ?>
    </head>
    <body>
        <ul style="list-style-type: none">
            <li style="display: inline"><h1 style="display: inline"><a href="crear-aerolinea.php" style="padding: 20px; margin: 15px">Registrar aerolinea</a></h1></li>
            <li style="display: inline"><h1 style="display: inline"><a href="crear-vuelo.php" style="padding: 20px; margin: 15px">Registrar vuelo</a></h1></li>
            <li style="display: inline"><h1 style="display: inline"><a href="resumen.php" style="padding: 20px; margin: 15px">Resumen</a></h1></li>
        </ul>



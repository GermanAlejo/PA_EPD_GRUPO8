<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-EJ2</title>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
    <body>

        <?php
        if (isset($_POST['enviar'])) {

            if (emptyForm()) {

                echo 'Nombre Completo: ' . $_POST['nombre'] . '<br>';
                echo 'Email: ' . $_POST['email'] . '<br>';
                echo 'Cuenta de Twitter: ' . $_POST['twitter'] . '<br>';
                echo 'Telefono Fijo: ' . $_POST['fijo'] . '<br>';
                echo 'Telefono Movil: ' . $_POST['movil'] . '<br>';
                echo 'Provincia: ' . $_POST['provincia'] . '<br>';
                echo 'Descripcion de la ruta: ' . $_POST['ruta'] . '<br>';
            } else {
                formulario();
            }
        } else {
            formulario();
        }

        function compruebaNombre() {
            $error = false;
            $nombre = $_POST['nombre'];
            $chr = mb_substr($nombre, 0, 1);
            if (!ctype_upper($chr)) {
                $error = true;
            }
            return $error;
        }

        function compruebaTwitter() {
            $error = false;
            $twitter = $_POST['twitter'];
            $chr = mb_substr($twitter, 0, 1);
            if (!strcmp($chr, '@')) {
                $error = true;
            }
            return $error;
        }

        function compruebaFijo() {
            $error = false;
            $fijo = $_POST['fijo'];
            $chr = mb_substr($fijo, 0, 1);
            if (!strcmp($chr, '9')) {
                $error = true;
            }
            return $error;
        }

        function compruebaMovil() {
            $error = false;
            $movil = $_POST['movil'];
            $chr = mb_substr($movil, 0, 1);
            if (!strcmp($chr, '6')) {
                $error = true;
            }
            return $error;
        }

        function emptyForm() {

            $required = array('nombre', 'email', 'twitter', 'fijo', 'movil', 'provincia', 'ruta');

            $error = false;
            $i = 0;
            while ($i < sizeof($required) && !$error) {
                if (!empty($_POST[$required[$i]]) || isset($_POST[$required[$i]])) {

                    if ($required[$i] == "nombre") {
                        $error = compruebaNombre();
                    } else if ($required[$i] == "email") {
                        $error = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                    } else if ($required[$i] == "twitter") {
                        $error = compruebaTwitter();
                    } else if ($required[$i] == "fijo") {
                        $error = compruebaFijo();
                    } else if ($required[$i] == "movil") {
                        $error = compruebaMovil();
                    }
                } else {
                    $error = true;
                }
                $i++;
            }
            return $error;
        }

        function formulario() {
            echo '<fieldset><form action="index.php" method="post">
                Nombre Completo:<input type="text" name="nombre"';
            if (isset($_POST['nombre'])) {
                echo 'value="' . $_POST['nombre'] . '">';
                if (compruebaNombre()) {
                    echo ' <div class="error"> El campo nombre debe ir lleno y con el formato: "Nombre"</div>';
                }
            } else {
                echo '>';
            }
            echo '<br>
                Correo electronico:<input type="text" name="email"';
            if (isset($_POST['email'])) {
                echo 'value="' . $_POST['email'] . '">';
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo ' <div class="error"> El campo email debe ir lleno y con el formato: "dirreccion@upo.es"</div>';
                }
            } else {
                echo '>';
            }

            echo '<br>
                
                Usuario Twitter:<input type="text" name="twitter"';
            if (isset($_POST['twitter'])) {
                echo 'value="' . $_POST['twitter'] . '">';
                if (!compruebaTwitter()) {
                    echo ' <div class="error"> El campo Twitter debe ir lleno y con el formato: "@twitter"</div>';
                }
            } else {
                echo '>';
            }


            echo '<br>
                Telefono fijo:<input type="tel" name="fijo"';
            if (isset($_POST['fijo'])) {
                echo 'value="' . $_POST['fijo'] . '">';
                if (!compruebaFijo()) {
                    echo ' <div class="error"> El campo Telefono Fijo debe ir lleno y con el formato: "954332211"</div>';
                }
            } else {
                echo '>';
            }
            echo '<br>
                Telefono movil:<input type="tel" name="movil"';
            if (isset($_POST['movil'])) {
                echo 'value="' . $_POST['movil'] . '">';
                if (!compruebaMovil()) {
                    echo ' <div class="error"> El campo Telefono Movil debe ir lleno y con el formato: "654222333"</div>';
                }
            } else {
                echo '>';
            }
            echo '<br>
                <select name="provincia" . ';

            if (isset($_POST['provincia'])) {
                echo 'value="' . $_POST['provincia'] . '"';
                
            }
            echo '><br>
                    <option value="sevilla" selected="selected">Sevilla</option>
                    <option value="malaga">Malaga</option>
                    <option value="slmeria">Almeria</option>
                    <option value="cadiz">Cadiz</option>
                    <option value="huelva">Huelva</option>
                    <option value="granada">Granada</option>
                    <option value="cordoba">Cordoba</option>
                    <option value="jaen">Jaen</option>
                    </select><br>';
            
            echo 'Descripcion de la ruta:<textarea rows="7" cols="" name="ruta"';
           /* if(isset($_POST['ruta'])){
                echo 'value="' . $_POST['ruta'] . '"';
                
            }*/
            echo '> </textarea><br>';
             echo '<button type="submit" name="enviar" value="enviar">Enviar</button>
            </form></fieldset>';
        }
        ?>

    </body>
</html>

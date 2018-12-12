<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-EJ2</title>
    </head>
    <body>

        <?php
        if (isset($_POST['enviar'])) {

            if (!emptyForm()) {

                echo 'Nombre Completo: ' . $_POST['nombre'] . '<br>';
                echo 'Email: ' . $_POST['email']. '<br>';
                echo 'Cuenta de Twitter: ' . $_POST['twitter']. '<br>';
                echo 'Telefono Fijo: ' . $_POST['fijo']. '<br>';
                echo 'Telefono Movil: ' . $_POST['movil']. '<br>';
                echo 'Provincia: ' . $_POST['provincia']. '<br>';
                echo 'Descripcion de la ruta: ' . $_POST['ruta']. '<br>';
            } else {
                formulario();
            }
        } else {
            formulario();
        }

        function emptyForm() {

            $required = array('nombre', 'email', 'twitter', 'fijo', 'movil', 'provincia', 'ruta');

            $error = false;
            foreach ($required as $field) {
                if (empty($_POST[$field]) || !isset($_POST[$field])) {
                    $error = true;
                    echo "El campo " . $field . " es necesario <br>";
                } else {
                    $error = false;
                }
            }
            return $error;
        }

        function formulario() {
            echo '<fieldset><form action="index.php" method="post">
                Nombre Completo:<input type="text" name="nombre"';
            if (isset($_POST['nombre'])) {
                echo 'value="' . $_POST['nombre'] . '"';
            }
            echo '><br>
                Correo electronico:<input type="email" name="email"';
            if (isset($_POST['email'])) {
                echo 'value="' . $_POST['email'] . '"';
            }

            echo '><br>
                
                Usuario Twitter:<input type="text" name="twitter"';
            if (isset($_POST['twitter'])) {
                echo 'value="' . $_POST['twitter'] . '"';
            }

            echo '><br>
                Telefono fijo:<input type="tel" name="fijo"';
            if (isset($_POST['fijo'])) {
                echo 'value="' . $_POST['fijo'] . '"';
            }
            echo '><br>
                Telefono movil:<input type="tel" name="movil"';
            if (isset($_POST['movil'])) {
                echo 'value="' . $_POST['movil'] . '"';
            }
            echo '><br>
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
            if (isset($_POST['ruta'])) {
                echo 'value="' . $_POST['ruta'] . '"';
            }
            echo '></textarea><br>
                <button type="submit" name="enviar" value="enviar">Enviar</button>
            </form></fieldset>';
        }
        ?>

    </body>
</html>

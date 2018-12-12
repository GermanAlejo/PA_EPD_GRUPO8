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

        function buscarUsuario($user) {
            $fichero = fopen("usuarios.csv", "r");
            if ($fichero) {
                flock($fichero, LOCK_SH);
                $encontrado = false;
                $usuario[] = "";
                while (!feof($fichero) && !$encontrado) {
                    $usuario = fgetcsv($fichero, 1024, ";");
                    if (strcmp($usuario[0], $user) == 0) {
                        return $encontrado = true;
                    }
                }
                unset($usuario);
                flock($fichero, LOCK_UN);
                fclose($fichero);
                return $encontrado;
            } else {
                echo "Error apertura del fichero";
            }
        }

        function soloPdf($fichero) {
            $tiposAceptado = 'application/pdf';
            if ($tiposAceptado == $fichero['type']) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function limiteTamanyo($fichero, $limite) {
            return $fichero['size'] <= $limite;
        }

        function escribeFicheroUsuario() {
            $fichero = fopen('usuarios.csv', 'a');
            flock($fichero, LOCK_EX);
            $cadena = $_POST['control_usuario_reg'] . ';' . $_POST['control_password_reg'] . ';' . $_POST['control_email_reg'] . ';' . $_POST['control_universidad_reg'] . "\n";
            fwrite($fichero, $cadena);
            flock($fichero, LOCK_UN);
            fclose($fichero);
        }

        function escribirFichero($user, $descrip) {

            $fichero = fopen('ficheros.csv', 'a');
            flock($fichero, LOCK_EX);
            $cadena = $_FILES['control_fichero']['name'] . ';' . time() . ';' . $descrip . ';' . $user . ';' . md5($_FILES['control_fichero']['name']) . "\n";
            fwrite($fichero, $cadena);
            flock($fichero, LOCK_UN);
            fclose($fichero);
        }

        function misFicheros() {
            $ficheros = array();
            $fiche = fopen('ficheros.csv', 'r');
            flock($fiche, LOCK_SH);
            while (!feof($fiche)) {
                $linea = fgetcsv($fiche, 2048, ";");
                if ($linea[3] == $_POST['control_usuario']) {
                    $ficheros[] = [$linea[0], $linea[2]];
                }
            }
            flock($fiche, LOCK_UN);
            fclose($fiche);
            return $ficheros;
        }

        function comprobarSiExiste($fichero) {
            $encontrado = FALSE;
            $fichero = fopen('ficheros.csv', 'r');
            flock($fichero, LOCK_SH);
            while (!feof($fichero) && !$encontrado) {
                $linea = fgetcsv($fichero, 2048, ";");
                if ($linea[4] == md5($fichero['name'])) {
                    return $encontrado = TRUE;
                }
            }
            return $encontrado;
        }

        function busquedaFichero($ficheros) {
            $archivos = array();

            foreach ($ficheros as $v) {
                $contenido = strpos($v[0], $_POST['palabra_busqueda']);
                if ($contenido === FALSE) {
                    
                } else {
                    $archivos[] = $v;
                }
            }
            return $archivos;
        }
        ?>

        <?php
        if (isset($_POST['enviar']) || isset($_POST['enviar_fichero']) || isset($_POST['busqueda'])) {
            if (isset($_POST['enviar'])) {
                if ($_POST['control_usuario'] == "") { 
                    $errores[] = 'Indique el nombre de usuario';
                }
                if ($_POST['control_password'] == "") { 
                    $errores[] = 'Indique su contrase&ntilde;a';
                }
            }

            if (!isset($errores)) {
                if (!buscarUsuario($_POST['control_usuario'])) {
                    $usu_no_encontrado = TRUE;
                } else {

                    if (isset($_POST['enviar_fichero'])) {
                        if (!soloPdf($_FILES['control_fichero'])) {
                            echo '<p style="color:red">Error: Tipo de fichero no aceptado </p>';
                        } else if (!limiteTamanyo($_FILES['control_fichero'], 5242880)) {
                            echo '<p style="color:red">Error: El tama&ntilde;o del fichero supera los 5M </p>';
                        } else if (comprobarSiExiste($_FILES['control_fichero'])) {
                            echo '<p style="color:red">Error: El fichero ya existe</p>';
                        } else {
                            move_uploaded_file($_FILES['control_fichero']['tmp_name'], 'archivos/' . $_FILES['control_fichero']['name']);
                            escribirFichero($_POST['control_usuario'], $_POST['control_descripcion']);
                        }
                    }



                    echo '<div>';
                    echo '<form method="POST" enctype="multipart/form-data">';
                    echo '<p><input type="file" name="control_fichero"></p>';
                    echo '<p><textarea name="control_descripcion"></textarea></p>';
                    echo '<input type="hidden" name="control_usuario" value="' . $_POST['control_usuario'] . '">';
                    echo '<p><input type="submit" name="enviar_fichero" value="Subir"></p>';
                    echo '</form>';
                    echo '</div>';

                    echo '<div>';
                    echo '<form method="POST"">';
                    echo '<p><input type="text" name="palabra_busqueda" placeholder="Buscar"></p>';
                    echo '<input type="hidden" name="control_usuario" value="' . $_POST['control_usuario'] . '">';
                    echo '<p><input type="submit" name="busqueda" value="Buscar"></p>';
                    echo '</form>';
                    echo '</div>';

                    $ficheros = misFicheros();

                    if (isset($_POST['busqueda']) && $_POST['palabra_busqueda'] != "") {
                        $ficheros = busquedaFichero($ficheros);
                    }

                    echo '<ul>';
                    foreach ($ficheros as $v) {
                        echo '<li><a href="archivos/' . $v[0] . '">' . $v[0] . '</a> -> ' . $v[1] . '</li>';
                    }
                    echo '</ul>';
                }
            }
        }

        if (isset($usu_no_encontrado)) {
            echo '<h1> Registrarse </h1>';
            if (isset($errores_reg)) {
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
            
            ?>
            <form method="POST">
                Usuario: <input type="text" name="control_usuario_reg"/>
                <br />
                <br />
                Contraseña: <input type="password" name="control_password_reg"/>
                <br />
                <br />
                Email: <input type="text" name="control_email_reg"/>
                <br />
                <br />
                Selecione la universidad:
                <br />
                <select name="control_universidad_reg">
                    <option value="Universidad de Almería">Universidad de Almer&iacute;a</option>
                    <option value="Universidad de Cadiz">Universidad de Cadiz</option>
                    <option value="Universidad de Cordoba">Universidad de Cordoba</option>
                    <option value="Universidad de Granada">Universidad de Granada</option>
                    <option value="Universidad de Huelva">Universidad de Huelva</option>
                    <option value="Universidad Internacional de Andalucía">Universidad Internacional de Andaluc&iacute;a</option>
                    <option value="Universidad de Jaén">Universidad de Ja&eacute;n</option>
                    <option value="Universidad de Málaga">Universidad de M&aacute;laga</option>
                    <option value="Universidad Pablo de Olavide">Universidad Pablo de Olavide</option>
                    <option value="Universidad de Sevilla">Universidad de Sevilla</option>
                </select>
                <br />
                <br />
                <input type="submit" name="enviar_reg" value="Enviar"/>
            </form>
            <?php
        }

        if ((!isset($_POST['enviar']) && !isset($_POST['enviar_fichero']) && !isset($_POST['busqueda'])) || isset($errores) || isset($_POST['enviar_reg'])) {

            if (isset($_POST['enviar_reg'])) {
                if ($_POST['control_usuario_reg'] == "") {
                    $errores_reg[] = 'Indique el nombre de usuario';
                }
                if ($_POST['control_password_reg'] == "") {
                    $errores_reg[] = 'Indique su contrase&ntilde;a';
                }
                if ($_POST['control_email_reg'] == "") {
                    $errores_reg[] = 'Introduzca el email';
                }
                if (!isset($errores_reg)) {
                    escribeFicheroUsuario();
                }
            }

            echo '<h1> Inicio de Sesion </h1>';
            if (isset($errores)) {
                echo '<p style="color:red">Errores cometidos:</p>';
                echo '<ul style="color:red">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
            ?>
            <form method="POST">
                Usuario: <input type="text" name="control_usuario"/>
                <br />
                <br />
                Contraseña: <input type="password" name="control_password"/>
                <br />
                <br />
                <input type="submit" name="enviar" value="Enviar"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
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
            $con = mysqli_connect("localhost", "root", "", "epd6p3");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            } else {
                $encontrado = false;
                //Consultar si ya existe dicho usuario
                $buscarUsuario = "SELECT * FROM USUARIOS WHERE usuario = ?";
                $stmt = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stmt, $buscarUsuario);
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                $count = mysqli_num_rows($resultado);
                if ($count >= 1) {
//es mejor tener >= por si acaso hay un fallo en la base de datos, pero podria ser perfectamente ==
                    return $encontrado = TRUE;
                } else {
                    return $encontrado;
                }
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
            $con = mysqli_connect("localhost", "root", "", "epd6p3");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            } else {
                $buscarUsuario = "INSERT INTO usuarios (usuario,password,correo,universidad)
           VALUES ('?','?', '?')";
                $stmt = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stmt, $buscarUsuario);
                mysqli_stmt_bind_param($stmt, "ssss", $_POST['control_usuario_reg'], $_POST['control_password_reg'], $_POST['control_email_reg'], $_POST['control_universidad_reg']);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                mysqli_close($con);
            }
        }

        function escribirFichero($user, $descrip) {
            $con = mysqli_connect("localhost", "root", "", "epd6p3");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            } else {
                $variable1 = $_FILES['control_fichero']['name'];
                $variable2 = md5($_FILES['control_fichero']['name']);
                $buscarUsuario = "INSERT INTO ficheros (nombre,titulo,usuario,hash)
           VALUES ('$variable1','$descrip', '$user','$variable2')";
                $stmt = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stmt, $buscarUsuario);
//                mysqli_stmt_bind_param($stmt, "sssb", $variable1, $descrip, $user, $variable2);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                mysqli_close($con);
            }
        }

        function misFicheros() {
            $ficheros = array();
            $con = mysqli_connect("localhost", "root", "", "epd6p3");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            } else {
                $consulta = "SELECT nombre,titulo FROM ficheros WHERE usuario = ?";
                $stmt = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stmt, $consulta);
                mysqli_stmt_bind_param($stmt, "s", $_POST['control_usuario']);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                //consulta tipo 2
//                $valor = $_POST['control_usuario'];
//                $consulta = "SELECT nombre,titulo FROM ficheros WHERE usuario = '$valor'";
//                $resultado = ingres_query($con, $consulta);
                //FIN consulta tipo 2
                $sizeFicheros = mysqli_num_rows($resultado);
//                echo $sizeFicheros."<br>";
//                $i = 0;
//                while ($sizeFicheros > 0) {
//                    $resultado = mysqli_fetch_array($resultado);
//                    $uno = $resultado['nombre'];
//                    $i++;
//                    $dos = $resultado['titulo'];
//                    $ficheros[] = [$uno, $dos];
//                    $i++;
//                    $sizeFicheros--;
//                }
                while ($fichero = $resultado->fetch_array()) {
                    $ficheros[] = $fichero;
                }
                mysqli_close($con);
            }
            return $ficheros;
        }

        function comprobarSiExiste($fichero) {
            $con = mysqli_connect("localhost", "root", "", "epd6p3");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            } else {
                $encontrado = false;
                //Consultar si ya existe dicho usuario
                $buscarUsuario = "SELECT * FROM ficheros WHERE nombre = ?";
                $stmt = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stmt, $buscarUsuario);
                mysqli_stmt_bind_param($stmt, "s", $fichero['name']);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                $count = mysqli_num_rows($resultado);
                if ($count >= 1) {
//es mejor tener >= por si acaso hay un fallo en la base de datos, pero podria ser perfectamente ==
                    return $encontrado = TRUE;
                } else {
                    return $encontrado;
                }
            }
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
                    foreach ($ficheros as $ficheros) {
                        echo '<li><a href="archivos/' . $ficheros[0] . '">' . $ficheros[0] . '</a> -> ' . $ficheros[1] . '</li>';
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
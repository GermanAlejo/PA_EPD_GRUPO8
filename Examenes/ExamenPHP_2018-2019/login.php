<?php

include_once 'libraries.php';

function loginForm() {

    if (isset($_POST['submit'])) {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

//conectamos a BD
            $con = dbConnection();
            $arraySanitize = array(
                FILTER_SANITIZE_STRING => $_POST['usuario'],
                FILTER_SANITIZE_STRING => $_POST['password'],
            );

            $formInput = filter_input_array(INPUT_POST, $arraySanitize);
            $usuario = $formInput['usuario'];
            $password = $formInput['password'];

//sql
            $sql = "SELECT * FROM `usuarios` WHERE nombre LIKE '" . $usuario . "';";
            $query = mysqli_query($con, $sql);

            if (!$query) {
                mysqli_close($con);
            } else if (mysqli_num_rows($query) == 1) {

                $aux = mysqli_fetch_array($query); //get the query result into an array

                if (password_verify($password, $aux['password'])) {

                    mysqli_close($con);
                    session_start();
                    $_SESSION['nombre'] = $aux['nombre'];
                    $_SESSION['tipo'] = $aux['tipo'];
                    $_SESSION['id'] = $aux['id'];
                } else {
                    logOut();
                    mysqli_close($con);
                    die("Usuario no encontrado");
                }
            } else {
                logOut();
                mysqli_close($con);
                die("Usuario no encontrado");
            }
        } else {

            unSetSession();
            echo "<br/>Please make sure you filled both email and password fields<br/>";
        }
    }
}

function logOut() {
    session_unset();
    session_destroy();
    header("Location: home.php");
}

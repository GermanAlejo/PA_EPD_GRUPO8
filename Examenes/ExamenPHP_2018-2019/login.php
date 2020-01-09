<?php

include_once 'libreria.php';

$error = [];

if (isset($_POST['btnLogin'])) {

    if (isset($_POST['usuario']) && isset($_POST['password'])) {

//conectamos a BD

        $con = dbConnection();
        $arraySanitize = array(
            'usuario' => FILTER_SANITIZE_STRING,
            'password' => FILTER_SANITIZE_STRING
        );
        
        $formInput = filter_input_array(INPUT_POST, $arraySanitize);
        $usuario = $formInput['usuario'];
        $password = $formInput['password'];

//sql
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE '" . $usuario . "';";
        $query = mysqli_query($con, $sql);


        if (mysqli_num_rows($query) == 1) {

            $aux = mysqli_fetch_array($query); //get the query result into an array
            
            if (password_verify($password, $aux['clave'])) {

                session_start();
                $_SESSION['nombre'] = $aux['nombre'];
                $_SESSION['tipo'] = $aux['tipo'];
                $_SESSION['id'] = $aux['id'];

                mysqli_close($con);
                print_r($aux);
                header('location: listado_tareas_desarrollador.php');
            } else {
                //logOut();
                mysqli_close($con);
                die("Usuario no encontrado");
                
            }
        } else {

            mysqli_close($con);
            $error[] = "Usuario no encontrado";
        }
    } else {

        unSetSession();
        echo "<br/>Please make sure you filled both email and password fields<br/>";
    }
}

print_r($error);




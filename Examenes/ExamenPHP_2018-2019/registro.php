<?php

include_once 'libreria.php';

$error = [];

if (isset($_POST['btnRegistrar'])) {


    if (isset($_POST['usuario']) && isset($_POST['password']) &&
            isset($_POST['email']) && isset($_POST['perfil'])) {

        $arraySanitize = array(
            'usuario' => FILTER_SANITIZE_STRING,
            'password' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_EMAIL
        );




        $formInput = filter_input_array(INPUT_POST, $arraySanitize);

        $nombre = $formInput['usuario'];
        $password = $formInput['password'];
        $email = $formInput['email'];
        $perfil = $_POST['perfil'];
        
        $con = dbConnection();

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

         $sql = "INSERT INTO usuarios (id, nombre, clave, email, perfil, tipo) "
          . "VALUES (NULL, '" . $nombre . "', '" . $hashedPass . "', '" . $email . "', '"
          . $perfil . "', 'desarrollador')";    
        $sqlUserExist = "SELECT COUNT(*) FROM usuario WHERE usuario.nombre='" . $nombre . "';";

        $query1 = mysqli_query($con, $sqlUserExist);

        if (mysqli_num_rows($query1) > 0) {
            $error[] = "User already registered";
            mysqli_close($con);
        } else {

            //$sql = "INSERT INTO usuarios (id, nombre, clave, email, perfil, tipo) VALUES (NULL, '" . $usuario . "', '" . $password . "', '" . $email . "', '" . $perfil . "', 'desarrollador')";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                $error[] = "Error inserting client into clientes table";
                mysqli_close($con);
            } else {

                //create session values
                $_SESSION["user"] = $userName;
                $_SESSION["user_id"] = $user_id;
                
                //print_r($error);

                mysqli_close($con);
                header('location: loginForm.php');
            }
        }
    } else {
        $error[] = "Se requieren todos los campos";
    }
}

print_r($error);


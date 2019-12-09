<?php

include_once 'libreria.php';

function registroForm() {


    if (isset($_POST['btnRegistrar'])) {

        if (isset($_POST['usuario']) && isset($_POST['password']) &&
                isset($_POST['email']) && isset($_POST['perfil'])) {

            $arraySanitize = array(
                FILTER_SANITIZE_STRING => $_POST['usuario'],
                FILTER_SANITIZE_STRING => $_POST['password'],
                FILTER_SANITIZE_EMAIL => $_POST['email']
            );

            $formInput = filter_input_array(INPUT_POST, $arraySanitize);

            $nombre = $formInput['usuario'];
            $password = $formInput['password'];
            $email = $formInput['email'];
            $perfil = $formInput['perfil'];

            $con = dbConnection();

            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `email`, `perfil`, `tipo`) "
                    . "VALUES (NULL, '". $nombre . "', '" . $hashedPass . "', '" . $email . "', '" 
                    . $perfil . "', '');";
            $sqlUserExist = "SELECT COUNT(*) FROM usuario WHERE usuario.correo=" . $userName . ";";
            
            $query1 = mysqli_query($con, $sqlUserExist);
            
             if (!$query1) {
                echo "error sql1";
                $error[] = "User already registered";
                mysqli_close($con);
            } else {
                
                $query2 = mysqli_query($con, $sql);
                
            }
        }
    }
}

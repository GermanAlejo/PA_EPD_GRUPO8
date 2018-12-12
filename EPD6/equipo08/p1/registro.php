<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//---------------------------CONSULTA---------------------------
$filtros = Array('password' => FILTER_SANITIZE_STRING, 'usuario' => FILTER_SANITIZE_STRING);
$entradas = filter_input_array(INPUT_POST, $filtros);

$nick = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

//$hash = password_hash($form_pass, PASSWORD_BCRYPT);


$con = mysqli_connect("localhost", "root", "", "epd6ej");
if (!$con) {
    die("Fallo conexion: " . mysqli_connect_errno());
} else {

//Consultar si ya existe dicho usuario
    $buscarUsuario = "SELECT * FROM USUARIOS WHERE usuario = ?";
    $stmt = mysqli_stmt_init($con);
    mysqli_stmt_prepare($stmt, $buscarUsuario);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $count = mysqli_num_rows($resultado);
    if ($count == 1) {
        echo "<br />" . "El Nombre de Usuario ya a sido usado." . "<br />";
        echo "<a href='login.html'>Por favor escoga otro Nombre</a>";
    } else {

        $cryp = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (nombre,usuario, password)
           VALUES ('$nick','$usuario', '$cryp')";

        if ($con->query($query) === TRUE) {
            echo "<br />" . "<h2>" . "Usuario Creado" . "</h2>";
            echo "<h4>" . "Bienvenido: " . $nick . "</h4>" . "\n\n";
            echo "<h4>" . "Hacer Login: " . "<a href='login.html'>Login</a>" . "</h4>";
        } else {
            echo "Error al crear el usuario." . $query . "<br>" . $conexion->error;
        }
    }
    mysqli_close($con);
}




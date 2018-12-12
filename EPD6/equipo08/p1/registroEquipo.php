<?php

session_start();


//---------------------------CONSULTA---------------------------
$filtros = Array('nombre' => FILTER_SANITIZE_STRING);
$entradas = filter_input_array(INPUT_POST, $filtros);

$nombre= $_POST['nombre'];
$ciudad = $_POST['ciudad'];


$con = mysqli_connect("localhost", "root", "", "epd6p1");
if (!$con) {
    die("Fallo conexion: " . mysqli_connect_errno());
}

//Consultar si ya existe dicho usuario
$buscarEquipo = "SELECT * FROM equipos WHERE equipo = ?";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $buscarEquipo);
mysqli_stmt_bind_param($stmt, "s", $nombre);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$count = mysqli_num_rows($resultado);
if ($count == 1) {
    echo "<br />" . "El Nombre de Usuario ya a sido usado." . "<br />";
    echo "<a href='login.html'>Por favor escoga otro Nombre</a>";
} else {

    
    $query = "INSERT INTO equipos (nombre,ciudad, PJ, PG, PP, PF, PE)
           VALUES ('$nombre','$ciudad', '0', '0', '0', '0', '0')";

    if ($con->query($query) === TRUE) {
        echo "<br />" . "<h2>" . "Equipo Creado" . "</h2>";
        echo "<h4>" . "Hacer Login: " . "<a href='login.html'>Login</a>" . "</h4>";
    } else {
        echo "Error al crear el equipo." . $query . "<br>" . $conexion->error;
    }
}
mysqli_close($con);



?>
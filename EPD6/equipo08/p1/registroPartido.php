<?php

$local = $_POST['local'];
$Visitante = $_POST['Visitante'];
$puntosLocal = $_POST['puntosLocal'];
$puntosVisitante = $_POST['puntosVisitante'];

if (strcmp($local, $Visitante) != 0) {
    echo"ERROR AL ELEGIR LOS EQUIPOS<br>";
} else {
    $con = mysqli_connect("localhost", "root", "", "epd6p1");
    if (!$con) {
        die("Fallo conexion: " . mysqli_connect_errno());
    } else {

        $query = "INSERT INTO partidos (local,Visitante, puntosLocal,puntosVisitante)
           VALUES ('$local','$Visitante', '$puntosLocal','$puntosVisitante')";
        if ($con->query($query) === TRUE) {
             echo "Partido creado con exito.";
        } else {
            echo "Error al crear el usuario." . $query . "<br>" . $conexion->error;
        }
    }
}

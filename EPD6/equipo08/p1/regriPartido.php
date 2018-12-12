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
    <from action="registroPartido.php" method="post">
        <p> Local Y Visitante</p>
        <select name="local" form="carform">
            <?php
            $con = mysqli_connect("localhost", "root", "", "epd6p1");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            }
            $consulta = "SELECT nombre FROM equipos ";
            $stmt = mysqli_stmt_init($con);
            mysqli_stmt_prepare($stmt, $consulta);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            while ($fichero = $resultado->fetch_array()) {
                echo'<option value="' . $fichero . '">' . $fichero . '</option>';
            }
            mysqli_close($con);
            ?>
        </select>
        <input type="text" name="puntosLocal" value="25" min="0" max="50" step="5">
        - 
        <input type="text" name="puntosVisitante" value="25" min="0" max="50" step="5">
        <select name="visitante" form="carform">
            <?php
            $con = mysqli_connect("localhost", "root", "", "epd6p1");
            if (!$con) {
                die("Fallo conexion: " . mysqli_connect_errno());
            }
            $consulta = "SELECT nombre FROM equipos ";
            $stmt = mysqli_stmt_init($con);
            mysqli_stmt_prepare($stmt, $consulta);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            while ($fichero = $resultado->fetch_array()) {
                echo'<option value="' . $fichero . '">' . $fichero . '</option>';
            }
            mysqli_close($con);
            ?>
        </select>
        <br>
        <button type="submit" name="enviar">Enviar</button>
    </from>
    <?php
    ?>
</body>
</html>

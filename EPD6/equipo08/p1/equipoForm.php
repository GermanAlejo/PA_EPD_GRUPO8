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
            session_start();
        ?>
        <fieldset>

            <form action="registroEquipo.php" method="post">
                <label>Nombre :<input type="text" name="nombre"></label><br/>
                <label>Ciudad :<select name ="ciudad">
                        <?php
                        $query = "SELECT nombre_ciudad FROM ciudades";
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbName = "epd6p1";

// Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } else {
                            echo "Connected successfully";
                            $aux = mysqli_query($conn, $query);


                            while ($ciudadesArray = mysqli_fetch_array($aux)) {
                                echo '<option value="' . $ciudadesArray[0] . '">' . $ciudadesArray[0] . '</option>';
                            }
                            mysqli_close($conn);
                        }
                        ?>

                    </select>
                    <label>
                        <button type="submit" name="registro">Registro</button>
                        </form>

                        </fieldset>
                        </body>
                        </html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD5-P2</title>
    </head>
    <body>
        <?php

        function insertImageInDB($imgName) {

            //$query = "SELECT image_name FROM images";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "epd6p2";

// Create connection
            $conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                echo "Connected successfully";

                //insert to table
                $query = "INSERT INTO images(image_name) VALUES('$imgName')";
                if ($conn->query($query) === TRUE) {
                    echo "Insert con exito";
                } else {
                    echo "Error al insertar";
                }

                mysqli_close($conn);
            }
        }

        function getImagesCat($categorias) {

            $date = date("Y-m-d_H-i-s");

            if (strpos($categorias, ";")) {

                $categoriasPerImg = explode(";", $categorias);
                
                for($i=0;$i<sizeof($categoriasPerImg);$i++){
                    
                    $categorias = explode(",", $categoriasPerImg[$i]);
                    
                    $imgName = $date . ".jpg";
                    $res = [$categorias, $imgName];
                    getImage($res);
                    insertImageInDB($imgName);
                    
                }
                
                
            } else {
                $categorias = explode(",", $categorias);
                //for ($i = 0; $i < sizeof($categorias); $i++) {

                    $imgName = $date . ".jpg";
                    $res = [$categorias, $imgName];
                    getImage($res);

                    insertImageInDB($imgName);
               // }
            }

            print_r($res);
        }

        function getImage($res) {

            // print_r($res);
            $url = "https://source.unsplash.com/featured/?";
            //$categorias = explode(",", $res[0]);
            $categorias = $res[0];
            $img = $res[1];

            for ($i = 0; $i < sizeof($categorias); $i++) {

                if ($i == 0) {
                    $url .= $categorias[$i];
                } else {
                    $url .= "," . $categorias[$i];
                }
            }

            // $rute = "img/" . $img;
            echo $url;
            copy($url, $img);
        }

        function printImages() {

            $query = "SELECT image_name FROM images";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "epd6p2";

// Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                echo "Connected successfully";
                $aux = mysqli_query($conn, $query);

             //   print_r($imgArray);
                echo '<div><table><tr>';

                while($imgArray = mysqli_fetch_array($aux)){
                //print_r($imgArray);

                    $img = $imgArray[0];
                   // echo "<br>".$img;
                    echo '<td><img width="50%" height="60%" src="' . $img . '">' . $img;

                    echo '</td>';
                }
                echo '<tr></table></div>';
                mysqli_close($conn);
            }
        }

        function formulario() {

            echo '<fieldset><form action="index.php" method="post"';
            if (isset($_POST['categorias'])) {
                echo 'value="' . $_POST['categorias'] . '"';
            }

            echo '><br>
                    <input type="checkbox" name="nature" value="nature">Nature
                    <input type="checkbox" name="lake" value="lake">lake
                    <input type="checkbox" name="forest" value="forest">forest
                    <input type="checkbox" name="dog" value="dog">dog
                    <input type="checkbox" name="car" value="car">car
                    <input type="checkbox" name="girl" value="girl">girl
                    <input type="checkbox" name="agent" value="agent">agent<br>';
            echo '<br>
                <h3>Adjuntar txt con las categorias deseadas separadas por coma:</h3>
                fichero: <input type="file" name="file">
                <br />
                    <button type="submit" name="enviar" value="enviar">Enviar</button>
                </form></fieldset>';
        }

        function getFile() {
            $categorias = "";

            $file = fopen($_FILES['file']['name'], 'r');

            if ($file) {
                flock($file, LOCK_SH);
                $categorias = fgets($file);
            }

            return $categorias;
        }

        function getCheckBox() {
            $categoria = "";

            if (isset($_POST['nature'])) {
                $categoria .= "nature,";
            }
            if (isset($_POST['lake'])) {
                $categoria .= "lake,";
            }
            if (isset($_POST['mountain'])) {
                $categoria .= "mountain,";
            }
            if (isset($_POST['forest'])) {
                $categoria .= "forest,";
            }
            if (isset($_POST['dog'])) {
                $categoria .= "dog,";
            }
            if (isset($_POST['cat'])) {
                $categoria .= "cat,";
            }
            if (isset($_POST['girl'])) {
                $categoria .= "girl,";
            }
            if (isset($_POST['agent'])) {
                $categoria .= "agent,";
            }

            if ($categoria != "") {
                $categoria = substr($categoria, 0, strlen($categoria) - 1);
            }

            return $categoria;
        }

        formulario();

        echo '<div>';

        if (isset($_POST['enviar'])) {
            if (!isset($_FILES['file']['name']) || empty($_FILES['file']['name'])) {

                $categorias = getCheckBox();
                getImagesCat($categorias);
            } else {
                $categorias = getFile();
                getImagesCat($categorias);
            }
        }

        echo '</div><div>';

        printImages();


        echo '</div>';
        ?>
    </body>
</html>

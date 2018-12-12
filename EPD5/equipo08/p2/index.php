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

        function writeFile($fileContent, $fileName) {

            $file = fopen($fileName, "a");

            for ($i = 0; $i < sizeof($fileContent); $i++) {

                fwrite($file, $fileContent[0] . "\t" . $fileContent[1] . "\n");
            }

            fclose($file);
        }

        function getImagesCat($categorias, $fileName) {

            $date = date("Y-m-d_H-i");
            $categoriasPerImg = explode(";", $categorias);

            $res = [];


            for ($i = 0; $i < sizeof($categoriasPerImg); $i++) {
                $fileName = $date;

                if (sizeof($categoriasPerImg) > 1) {
                    $fileName = $fileName . "-" . chr(65 + $i);
                }

                $fileName = $fileName . ".jpg";

                $res[] = [$categoriasPerImg[$i], $fileName];
            }

            

            for ($i = 0; $i < sizeof($res); $i++) {

                getImage($res);
            }
        }

        function getImage($res) {

            print_r($res);
            $url = "https://source.unsplash.com/featured/?";
            $categorias = explode(",", $res[0]);
            $img = $res[1];

            for ($i = 0; $i < sizeof($categorias); $i++) {

                if ($i == 0) {
                    $url .= $categorias[$i];
                } else {
                    $url .= "," . $categorias[$i];
                }
            }

            $rute = "img/" . $img;

            file_put_contents($rute, file_get_contents($url));
        }

        function printImages($fileName) {

            $fileLines = file($fileName);


            echo '<div><table><tr>';

            for ($i = 0; $i < sizeof($fileLines); $i++) {

                $lines = explode("\t", $fileLines[$i]);
                $img = $lines[0];

                echo '<td><img width="50%" height="60%" src="img/' . $img . '">' . $img;

                for ($j = 1; $j < sizeof($lines); $j++) {
                    echo $lines[$j] . "/";
                }

                echo '</td>';
            }
            echo '<tr></table></div>';
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
        
        function getFile(){
            $categorias = "";
            
            $file = fopen($_FILES['file']['tmp_name'], 'r');
            
            if($file){
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
        $fileName = "imgFile.txt";
        
        echo '<div>';

        if (isset($_POST['enviar'])) {
            if ($_FILES['file']['error'] > 0) {
                $categorias = getCheckBox();
                getImagesCat($categorias, $fileName);
            } else {
                $categorias = getFile();
                getImagesCat($categorias, $fileName);
            }
        }

        echo '</div><div>';
        
        printImages($fileName);
        
        
        echo '</div>';
        ?>
    </body>
</html>

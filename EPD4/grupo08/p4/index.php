<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>P4</title>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
    <body>

        <?php
        /*
         * TODAS LAS FUNCIONES NECESARIAS
         */

        function printr($array, $print = true) { //imprime o devuelve la cadena
            if ($print)
                return print_r($array, true);
            else
                echo '<pre>' . print_r($array, true) . '</pre>';    //tabula bien gracias a los <pre>
        }

        function imprimirMatriz($matriz) {  //imprime cualquier matriz de una nueva forma
            echo '<br>';
            echo "<table style= 'width:50%'>
            <thead>
                <tr>
                    Tabla
                </tr>
            </thead>

            <tbody>";


            $sizeX = count($matriz);
            $sizeY = 0;
            for ($i = 0; $i < $sizeX; $i++) {
                echo "<tr>";
                $sizeY = count($matriz[$i]);
                //echo 'Fila :' . $i . '<br>';
                for ($j = 0; $j < $sizeY; $j++) {
                    //echo '<pre>' . $matriz[$i][$j] . '</pre>';    //imprime una fila en lineas diferentes
                    echo "<td>" . $matriz[$i][$j] . "</td>";   //imprime una fila en la misma linea
                }
                echo "</tr>";
            }
            echo "</tbody> </table>";
            echo '<br>';
        }

        function imprimirVector($vectorDiagonal) {  //imprime cualquier matriz de una nueva forma
            $sizeX = count($vectorDiagonal);
            //echo 'SIZE ' . $sizeX . '<br>';
            for ($i = 0; $i < $sizeX; $i++) {
                //echo '<pre>' . $matriz[$i][$j] . '</pre>';    //imprime una fila en lineas diferentes
                echo $vectorDiagonal[$i];   //imprime una fila en la misma linea
            }
            echo '<br>';
        }

        function sumElemMatrix($matriz) {
            $total = 0;
            $sizeX = count($matriz);
            $sizeY = 0;
            for ($i = 0; $i < $sizeX; $i++) {
                $sizeY = count($matriz[$i]);
                for ($j = 0; $j < $sizeY; $j++) {
                    $total += $matriz[$i][$j];
                }
            }
            echo 'sumaTotal :' . $total . '<br>';
            return $total;
        }

        function comprobarEscalar($escalar, $matriz) {
            $check = false;
            if ($escalar < sumElemMatrix($matriz)) {
                $check = true;
            }
            echo 'comprobarEs :' . $check . '<br>';
            return $check;
        }

        function nuevaMatriz1($escalar, $matriz) {
            if (comprobarEscalar($escalar, $matriz)) {
                $sizeX = count($matriz);
                $sizeY = 0;
                for ($i = 0; $i < $sizeX; $i++) {
                    $sizeY = count($matriz[$i]);
                    for ($j = 0; $j < $sizeY; $j++) {
                        if ($i > $j) {
                            $matriz[$i][$j] = $escalar;
                        }
                    }
                }
            } else {
                $matriz = -1;
            }
            return $matriz;
        }

        function nuevaDiagonal($escalar, $matriz) {
            $vectorDiagonal = array();
            $sizeX = count($matriz);
            $sizeY = 0;
            for ($i = 0; $i < $sizeX; $i++) {
                $sizeY = count($matriz[$i]);
                for ($j = 0; $j < $sizeY; $j++) {
                    if ($i == $j) {
                        //array_push($vectorDiagonal, $matriz[$i][$j] * $escalar);
                        $vectorDiagonal[] = $matriz[$i][$j] * $escalar;
                        /* comprueba que todo se meta correctamente
                          echo $i . '<br>';
                          echo'hola' . '<br>';
                          echo $matriz[$i][$j] . '<br>';
                          echo'fin ' . '<br>';
                          echo $vectorDiagonal[$i] . '<br>';
                         */
                    }
                }
            }
            return $vectorDiagonal;
        }

        function pedirDim() {
            echo '<form action = "index.php" method = "post">
            <fieldset>
                <legend>Problema 4</legend><br> 
                <label> X <input name = "dimX" type ="text" value="2"/><br /></label>
                <label> Y <input name = "dimY" type ="text" value="2"/><br /></label></fieldset>
            <label><input type = "submit" type ="button" value="Enviar"/></label>
        </form>';
        }

        function comprobar($matri) {
            $encontrado = 0;
            $dimX = count($matri);
            for ($i = 0; $i < $dimX; $i++) {
                $dimY = count($matri[$i]);
                for ($j = 0; $j < $dimY; $j++) {

                    if (isset($matri[$i][$j]) && !is_numeric($matri[$i][$j])) {
                        $encontrado = 1;
                    }
                }
            }
            return $encontrado;
        }

        function pedirMatriz($matri, $dimX, $dimY) {
            #&#8220;="
            echo '<form action = "index.php" method = "post">';
            echo '<label> Escalar <input name = "escalarNum" type = "text" value ="';
            if (isset($_POST['escalarNum'])) {
                $escalar = $_POST['escalarNum'];
                echo $escalar . '"';
                if (!is_numeric($escalar)) {
                    echo ' class="error"';
                }
            } else {
                echo '7"';
            }
            echo '/><br /></label>';
            for ($i = 0; $i < $dimX; $i++) {
                for ($j = 0; $j < $dimY; $j++) {
                    echo '<label>' . 'matri ' . $i . $j . ' <input name = "matri[' . $i . '][' . $j . ']" type ="text" value="';
                    #$matriz[$i][$j] = $_POST['valor'. $i . $j .''];
                    if (isset($matri[$i][$j])) {
                        echo $matri[$i][$j] . '"';
                        if (!is_numeric($matri[$i][$j])) {
                            echo ' class="error"';
                        }
                    } else {
                        echo '7"';
                    }
                    echo '/><br /></label>';
                }
            }
            echo '<label><input type = "submit" type ="button" value="Enviar"/></label>';
            echo "</form>";
        }

        //----------------------------MAIN2-----------------------------------
        $matrix = array(
            array()
        );
        if (isset($_POST['dimX']) && isset($_POST['dimY'])) {

            $dimX = $_POST['dimX'];
            $dimY = $_POST['dimY'];

            $matri = array();
            echo "<br>";
            echo "Dimension X :" . $dimX . " y Dimension Y :" . $dimY . "<br>";
            if (isset($_POST['matri']) && isset($_POST['escalarNum'])) {
                $escalar = $_POST['escalarNum'];
                $matri = $_POST['matri'];
                echo "Escalar:" . $escalar . "<br>";
            } else {
                pedirMatriz($matri, $dimX, $dimY);
            }
        } else {
            if (isset($_POST['matri'])) {
                $escalar = $_POST['escalarNum'];
                $matri = $_POST['matri'];
                echo "Escalar:" . $escalar . "<br>";
                if (0 == comprobar($matri) && is_numeric($escalar)) {
                    echo '<br>correcto matriz';
                    //----------------------------MAIN2-----------------------------------
                    imprimirMatriz($matri);
                    $matriz2 = nuevaMatriz1($escalar, $matri);
                    imprimirMatriz($matriz2);
                    $vectorDiagonal = nuevaDiagonal($escalar, $matri);
                    imprimirVector($vectorDiagonal);
                    //--------------------------- FIN MAIN2--------------------------------
                } else {
                    pedirMatriz($matri, count($matri), count($matri[0]));
                }
            } else {
                pedirDim();
            }
        }
        //--------------------------- FIN MAIN2--------------------------------
        ?>

    </body>
</html>

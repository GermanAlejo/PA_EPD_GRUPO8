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

        /*
          //----------------------------TESTEO-----------------------------------

          function prueba($x) {
          $x += 1;
          echo 'Dentro de la funcion :' . $x . '<br>';
          return $x;
          }

          $x = 55;
          echo 'Main :' . $x . '<br>';
          $y = prueba($x);
          echo 'Despues de la funcion :' . $x . ' y :' . $y . '<br>';

          $check = False;
          echo 'Main :' . $check . '<br>';

          $trayecto = array(
          array(1, 2, 3, 4, 5, 6),
          array(1, 2, 3, 5),
          array(1, 2, 3, 4, 5, 6),
          array(1, 2, 3, 4, 5, 6, 7)
          );
          $trayecto2 = array(
          array(1, 2, 3, 4, 5, 6),
          array(1, 2, 3, 4, 5, 6)
          );
          $escalar = 1;

          $sizeY = count($trayecto);
          $sizeX = count($trayecto[0]);
          $sizeZ = count($trayecto[1]);
          echo 'Y :' . $sizeY . '<br>' . 'X :' . $sizeX . '<br>' . 'Z :' . $sizeZ;
          echo'<br>';
          printr($trayecto, false);
          echo'<br>';
          echo'<br>';
          echo'<br>';
          imprimirMatriz($trayecto);

          echo'<br>';
          echo'<br>';
          echo'<br>';
          imprimirMatriz($trayecto2);
          echo'<br>';
          echo'<br>';
          echo'<br>';
          $trayecto2 = nuevaMatriz1($escalar, $trayecto);
          if ($trayecto2 == -1) {
          echo 'fallo con escalar' . '<br>';
          } else {
          imprimirMatriz($trayecto2);
          }
          echo'<br>';
          echo'<br>';
          echo'<br>';
          $vectorDiagonal = nuevaDiagonal($escalar, $trayecto);
          imprimirVector($vectorDiagonal);


          //--------------------------- FIN TEST --------------------------------
         */


        //----------------------------MAIN-----------------------------------
        $matriz = array(
            array(1, 2),
            array(1),
            array(1, 2, 3),
            array(1, 2, 3, 4)
        );
        $escalar = 1;
        echo "Escalar:" . $escalar . "<br>";
        imprimirMatriz($matriz);
        $matriz2 = nuevaMatriz1($escalar, $matriz);
        imprimirMatriz($matriz2);
        $vectorDiagonal = nuevaDiagonal($escalar, $matriz);
        imprimirVector($vectorDiagonal);

        //--------------------------- FIN MAIN --------------------------------
        //
        ?>
    </body>
</html>

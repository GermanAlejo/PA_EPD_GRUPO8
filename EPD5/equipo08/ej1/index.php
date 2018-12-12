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

        function comprobarIP($cadenaIp) {
            $no = "No es una IP";
            $si = "Es una Ip";
            if (filter_var($cadenaIp, FILTER_VALIDATE_IP)) {
                echo $si . "<br>";
            } else {
                echo $no . "<br>";
            }

            /**
              $cont = 0;
              $parte = explode(".", $cadenaIp);

              if (!isset($parte[0]) || !filter_var($parte[0], FILTER_SANITIZE_NUMBER_INT)) {
              $cont++;
              }
              if (!isset($parte[1]) || !filter_var($parte[1], FILTER_SANITIZE_NUMBER_INT)) {
              $cont++;
              }
              if (!isset($parte[2]) || !filter_var($parte[2], FILTER_SANITIZE_NUMBER_INT)) {
              $cont++;
              }
              if (!isset($parte[3]) || !filter_var($parte[3], FILTER_SANITIZE_NUMBER_INT)) {
              $cont++;
              }
              if ($cont == 0) {
              echo $si . "<br>";
              } else {
              echo $no . "<br>";
              }
             */
        }

        function comprobarPuerto($cadenaPuerto) {
            $no = "No es un PUERTO valido";
            $si = "Es un PUERTO valido";
            if (filter_var($cadenaPuerto, FILTER_SANITIZE_NUMBER_INT) && $cadenaPuerto <= 1500 && $cadenaPuerto >= 1000) {
                echo $si . "<br>";
            } else {
                echo $no . "<br>";
            }
        }
        ?>
        <FORM action="index.php" method="post">
            <table width="200" border="0" cellspacing="0" cellpadding="7">
                <tr>
                    <td>Texto</td>
                    <td><input type="text" name="texto" value="1.2.3.4 4.3.2.1 1499 1001" maxlength="140" placeholder="prueba"></td>  
                </tr>
            </table>
            <input type="submit" value="Enviar">
        </FORM>

        <?php
        $vector = array("un", "intento");
        $vacio = " ";
        if (isset($_POST['texto'])) {
            $textPrueba = $_POST['texto'];
            $sizeCadena = strlen($textPrueba);

            $porcion = explode(" ", $textPrueba);
            if (isset($porcion[0])) {
                echo $porcion[0] . "<br>"; // porción1
                comprobarIP($porcion[0]);
            }
            if (isset($porcion[1])) {
                echo $porcion[1] . "<br>"; // porción2
                comprobarIP($porcion[1]);
            }
            if (isset($porcion[2])) {
                echo $porcion[2] . "<br>"; // porción3
                comprobarPuerto($porcion[2]);
            }
            if (isset($porcion[3])) {
                echo $porcion[3] . "<br>"; // porción4
                comprobarPuerto($porcion[3]);
            }
        }


        /*
          if ($sizeCadena < 11 && $sizeCadena > 0) {
          echo $textPrueba . '<br>';
          echo 'Todo correcto y yo que me alegro' . '<br>';
          } else if ($sizeCadena > 10) {
          $textFin = substr($textPrueba, 0, 10);
          echo '<b>' . $textFin . "..." . '<br>';
          echo 'Muy largo' . '</b>' . '<br>';
          } else if ($sizeCadena == 0) {
          echo '<b>' . $vector[0] . '<br>';
          echo 'demasiado pequeño' . '</b>' . '<br>';
          } else {
          echo 'Mete algo, pero no trolees ' . '<br>';
          }
          echo 'Fin illo ' . '<br>';
         */
        ?>
    </body>
</html>

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
        <FORM action="index.php" method="post">
            <table width="200" border="0" cellspacing="0" cellpadding="7">
                <tr>
                    <td>Texto</td>
                    <td><input type="text" name="texto" value="textoPrueba" maxlength="140" placeholder="prueba"></td>
                </tr>
            </table>
            <input type="submit" value="Enviar">
        </FORM>

        <?php
        $vector = array("un", "intento");
        $textPrueba = $_POST['texto'];
        $sizeCadena = strlen($textPrueba);
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
        ?>
    </body>
</html>

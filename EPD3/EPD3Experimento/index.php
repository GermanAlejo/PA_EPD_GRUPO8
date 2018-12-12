<!DOCTYPE html>

<html>
    <body>
        <?php
        $salida = '';
        for ($i = 0; $i<10; $i++) {
            $salida .= 'Vuelta' . $i . ' ';
            echo $salida . "<br>";
        }
        ?>
    </body>
</html>
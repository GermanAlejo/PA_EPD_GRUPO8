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
        <script type="text/javascript">
            function area(lado1, lado2, grados) {
                var radianes = grados * (Math.PI / 180);
                var total = lado1 * lado2 * Math.sin(radianes);
                total = total / 2;
                total = Math.round(total * 100) / 100;
                return total;
            }
        </script>
    </head>
    <body>
        <script type="text/javascript">
            var lado1 = prompt("Lado 1 ");
            var lado2 = prompt("Lado 2 ");
            var grados = prompt("Grados del angulo que forman los lados ");
            var fin = area(lado1, lado2, grados);
            alert("Los lados son " + lado1 + " y " + lado2 + " ,los grados del angulo son : " + grados + " . El area final es : " + fin);
        </script>
    </body>
</html>

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
            function comprobarNumFibo(numPrincipal) {
                var encontrado = false;
                var a = 0;
                var b = 1;
                var c = 0;
//                document.write(a);
//                document.write("<br>");
//                document.write(b);
//                document.write("<br>");
//                document.write(c);
//                document.write("<br>");
                if (numPrincipal == c) {
                    encontrado = true;
                } else {
                    while (numPrincipal > a) {
                        a = b + c;
                        c = b;
                        b = a;
//                        document.write("Intento a: " + a + "num: " + numPrincipal);
//                        document.write("<br>");
                        if (a == numPrincipal) {
                            encontrado = true;
                        }
                    }
                }
//                document.write(numPrincipal);
//                document.write("<br>");
//                document.write(encontrado);
//                document.write("<br>");
                return encontrado;
            }
        </script>
    </head>
    <body>
        <script type="text/javascript">
            var encontrado = true;
            var contDentro = 0;
            var contNoDentro = 0;
            while (encontrado) {
                var numPrincipal = prompt("Un numero a comprobar si pertenece a la sucesion de Fibonacci. ");
                if (numPrincipal < 0) {
                    encontrado = false;
                } else {
                    if (comprobarNumFibo(numPrincipal) == true) {
                        contDentro++;
                    } else {
                        contNoDentro++;
                    }
                }
            }
            document.write("El resultado final de los contadores es :");
            document.write("<br>");
            if (contDentro < contNoDentro) {
                document.write("Contador de elementos que si pertenecen : ");
                document.write(contDentro);
                document.write("<br>");
                document.write("Contador de elementos que no pertenecen : ");
                document.write(contNoDentro + " rojo ");
                document.write("<br>");
            } else {
                document.write("Contador de elementos que si pertenecen : ");
                document.write(contDentro + " rojo ");
                document.write("<br>");
                document.write("Contador de elementos que no pertenecen : ");
                document.write(contNoDentro);
                document.write("<br>");
            }

        </script>

        <?php ?>
    </body>
</html>

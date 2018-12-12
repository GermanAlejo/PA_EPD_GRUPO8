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
            function toFixed(cadenaPrincipal, potencia) {
                var num = cadenaPrincipal;
                var i;
                for (i = 0; i < potencia; i++) {
                    num = num * 10;
                }
                num = Math.round(num);
                for (i = 0; i < potencia; i++) {
                    num = num / 10;
                }
                return num;
            }

            function fillZeros(cad, dec) {

                var encontrado = false;
                var i = 0;
                var pos;
                var numDec = cad.length - 1;//Math.trunc(cad)).length;

                if (numDec < dec) {

                    for (var i = 0; i < dec; i++) {

                        if (i === cad.length) {
                            cad += '0';
                        }

                        /* if (encontrado) {
                         cad.replaceAt(i, '0');
                         }*/

                    }
                }

                return cad;
            }
        </script>
    </head>
    <body>
        <script type="text/javascript">
//            var numEx =prompt("numEx");
//            numEx= numEx*10000;
//            numEx= numEx/100;
            var cadenaPrincipal = prompt(/*numEx+" "+*/"Un numero, si lleva decimales usa el . ");
            var potencia = prompt("Numero al que redondear la cantidad de decimas ");
            var resultado = toFixed(cadenaPrincipal, potencia);
            var cadena = fillZeros(resultado.toString(), potencia);
            alert('El resultado de redondear "' + cadenaPrincipal + '" a "' + potencia + '" es ' + cadena);
        </script>
    </body>
</html>

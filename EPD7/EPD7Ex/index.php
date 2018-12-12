<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <script type="text/javascript">
            /*function hola(texto){
                alert(texto);
            }*/
        </script>
        <script type="text/javascript" src="prueba.js"></script>
    </head>
    <body>

<script type="text/javascript">
            hola2("loko");
        </script>

    </body>
    
</html>
<html>
    <head>
        <script type="text/javascript">
            
        function hola() {
                var cadena = "¡Hola mundo!";
                        document.write(cadena);
            }
            //-->
<!--
        </script>
    </head>
    <body>
    <script type="text/javascript">
            
    hola();
            
            </script>
        </body>
    </html>//-->
<!--
<html>
    <head>
        <script type="text/javascript">
            
        function hola(Nombre) {
                document.write("¡Hola " + Nombre + "!");
            }
            
        </script>
    </head>
    <body>
    <script type="text/javascript">
<!--
var Nombre = prompt("Dime tu nombre", "");
        hola(Nombre);
        
        </script>
    </body>
</html>//-->
<html>
    <head>
        <script type="text/javascript">
           
        function power(numero, p) {
                //alert("Calculando potencia de "+p+ " de " + numero);
                if(p==1)
                    return numero * power(numero, p - 1);
            }
            
        </script>
    </head>
    <body>
    <script type="text/javascript">
            
    var numero = prompt("¿A que numero le calculamos la potencia?", "");
            var potencia = prompt("la potencia ");
            var resultado = power(numero, potencia);
            alert("La potencia de " + potencia + " de " + numero +
                    " es " + resultado);
            
            </script>
        </body>
    </html>


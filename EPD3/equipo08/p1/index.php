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
        
        //esta formula devolbera un booleano indicando si es martes 13 o no
        //¿es el 13 del mes y del año martes?
        function formula($mes,$anyo){
            $diaBuscado = 13;//buscammos los dia 13 del mes
            $validacion = false;
            $centuria = floor($anyo / 100);//calcular el siglo a partir del año
            $anyoCenturia = $anyo % 100; //calcular el año dentro del siglo a partir del año
            
            $x1=floor(((13*$mes)-1)/5);
            $x2=floor($anyoCenturia/4);
            $x3=floor($centuria/4);
            
            $diaSemana=($diaBuscado + $x1 + $anyoCenturia + $x2 + $x3 -(2*$centuria))%7;
            
            //$diaSemana=($diaBuscado + (floor(1/5*(13*$mes)-1)) + $anyoCenturia + (floor(1/4 * ($anyoCenturia))) + (floor((1/4)*$centuria)))%7;
            
            if($diaSemana==2){
                $validacion=true;
            }
            
            return $validacion;
        }
        
        
        $anyoInicial=2018;
        $numAnyos = 100;
        
        
        for($i=0;$i<10;$i++){
            
            for($j=1;$j<=12;$j++){
                $esMartes = formula($j, $anyoInicial);
                if($esMartes){
                    echo "Martes 13-> Mes:$j del año $anyoInicial <br/>";
                    
                }
            }
            
            $anyoInicial++;

        }
        
        
        ?>
    </body>
</html>

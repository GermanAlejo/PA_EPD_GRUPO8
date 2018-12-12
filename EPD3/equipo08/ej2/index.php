<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EPD3_Ej2</title>
    </head>
    <body>
        <?php
        
        function calculaDiasMes($mes,$anyo){
            $diasMes=0;
            if($mes==2){
                if($anyo%4==0){
                    $diasMes=29;
                }else{
                    $diasMes=28;
                }
            }else if($mes%2==0){
                $diasMes=30;
            }else{
                $diasMes=31;
            }
            return $diasMes;
        }
        

        function calculaFecha($dia,$mes,$anyo,$sumaDias) {
            
            $fecha="";

                if ($mes > 0 && $mes < 12 && $dia>0 && $dia<32) {
                    //fecha valida
                    
                    $diasMes = 0;
                    $dia+=$sumaDias;
                    $encontrado=false;
                    while(!$encontrado){
                        $diasMes =  calculaDiasMes($mes, $anyo);
                        if($dia<=$diasMes){
                            $encontrado=true;
                        }else{
                           $dia-=$diasMes;
                           $mes++;
                           if($mes>12){
                              $mes=1;
                              $anyo++;
                           }
                        }
                    }
                    
                    $fecha = $dia . "/" . $mes . "/" . $anyo;
                }else{
                    //fecha no valida
                    $fecha = "La fecha introducida  es invalida";
                }
            
            return $fecha;
        }
        
        $dia = 10;
        $mes = 5;
        $anyo=2017;
        $sumaDias=36;
        
        $fecha = calculaFecha($dia, $mes, $anyo, $sumaDias);
        
        echo "Fecha:" . $dia . "/" . $mes . "/" . $anyo . " Numero de dias: " . $sumaDias. "<br>";
        echo "La nueva fecha es:" . $fecha. "<br>";
       
        
        $dia = 23;
        $mes = 7;
        $anyo=2017;
        $sumaDias=3;
        
        $fecha = calculaFecha($dia, $mes, $anyo, $sumaDias);
        
        echo "Fecha:" . $dia . "/" . $mes . "/" . $anyo . " Numero de dias: " . $sumaDias . "<br>";
        echo "La nueva fecha es:" . $fecha. "<br>";
        
        
        $dia = 30;
        $mes = 8;
        $anyo=2012;
        $sumaDias=100;
        
        $fecha = calculaFecha($dia, $mes, $anyo, $sumaDias);
        
        echo "Fecha:" . $dia . "/" . $mes . "/" . $anyo . " Numero de dias: " . $sumaDias. "<br>";
        echo "La nueva fecha es:" . $fecha. "<br>";
        
        $dia = 31;
        $mes = 13;
        $anyo=2012;
        $sumaDias=100;
        
        $fecha = calculaFecha($dia, $mes, $anyo, $sumaDias);
        
        echo "Fecha:" . $dia . "/" . $mes . "/" . $anyo . " Numero de dias: " . $sumaDias. "<br>";
        echo "La nueva fecha es:" . $fecha. "<br>";
        
        
        ?>
    </body>
</html>

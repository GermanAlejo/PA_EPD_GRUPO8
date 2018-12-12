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
        
            //esta funcion calcula el porcentaje de descanso de cada persona
            function calcularPorcentaje($actividadFisica){
                $sumaTiempos=0;
                for($i=0;$i<(sizeof($actividadFisica[$i]));$i++){
                    for($j=0;$j<(sizeof($actividadFisica[$i][$j]));$j++){
                        $sumaTiempos = $actividadFisica[$i][$j] + $actividadFisica[$i][$j+1] + $actividadFisica[$i][$j+2];
                        $actividadFisica[$i][$j+3] = round((100/$sumaTiempos) * $actividadFisica[$i][$j]);
                        
                    }
                }
                return $actividadFisica;
            }
            
            function printMatrix($matriz) {
            echo "Matriz: ";
            for ($i = 0; $i < sizeof($matriz); $i++) {
                echo "<br>";
                for ($j = 0; $j < sizeof($matriz[$i]); $j++) {
                    echo $matriz[$i][$j];
                    if ($j != sizeof($matriz[$i]) - 1) {
                        echo ", ";
                    }
                }
            }
            echo "<br>";
        }
            
            
            function calcularMedias($actividadFisica){
                $sumaMedia=0;
                $i=0;
                $ySize = sizeof($actividadFisica)-1;
                $xSize = sizeof($actividadFisica[0])-1;
 
                for($j=0;$j<$ySize;$j++){
                    for($i=0;$i<$xSize;$i++){
                        
                        if($i!=$xSize-1){
                            $sumaMedia+=$actividadFisica[$i][$j];
                            
                        }else{
                            $sumaMedia+=$actividadFisica[$i][$j];
                            $actividadFisica[$i+1][$j]=floor($sumaMedia/$xSize);
                            $sumaMedia = 0;
                                    
                        }
                        
                    }
                }
                
                return $actividadFisica;
            }
        
            //cada fila del array reresenta una persona, excepto la ultima que son la media
            //las columnas representan el timepo: descansando, caminando, corriendo, y porcentaje de descanso sobre el total
            $actividadFisica = array(
                array(30,20,20,0),
                array(120,100,10,0),
                array(20,20,20,0),
                array(0,0,0)
            );
        
            $actividadFisica = calcularPorcentaje($actividadFisica);
            $actividadFisica = calcularMedias($actividadFisica);
            //printMatrix($actividadFisica);
            //print_r($actividadFisica);
        
           
            echo "<table style= 'width:50%'>
            <thead>
                <tr>
                    Tabla datos tiempos
                </tr>
                <tr>
                    <td>Reposo</td>
                    <td>Caminando</td>
                    <td>Corriendo</td>
                    <td>Porcentajes Descanso</td>
                </tr>
            </thead>

            <tbody>";
            for ($i = 0; $i <= sizeof($actividadFisica[$i]); $i++) {
                echo "<tr>";
                for ($j = 0; $j < sizeof($actividadFisica[$i][$j]); $j++) {
                    echo "<td>" . $actividadFisica[$i][$j] . "</td><td>" . $actividadFisica[$i][$j+1] . "</td><td>"
                    . $actividadFisica[$i][$j+2] . "</td><td>" . $actividadFisica[$i][$j+3] . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody> </table>";
        
            
        ?>
    </body>
</html>

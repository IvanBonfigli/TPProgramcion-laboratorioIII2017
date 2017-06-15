<?php
    $HoraActual = localtime();
    $HoraAnterior = "2017-05-13 20:00:00";
    $HoraActual = ($HoraActual[5]+1900)."-".$HoraActual[4]."-".$HoraActual[3]." ".$HoraActual[2].":".$HoraActual[1].":".$HoraActual[0];
    $MinutosTotales = ceil((strtotime($HoraActual)- strtotime($HoraAnterior))/60);
    $HorasTotales;
       
        $decimal = explode(".",($MinutosTotales/60));
        $decimal = "0".".".$decimal[1] + 0;
       
        if ($decimal <= 0.15)
        {
            $hora = floor($MinutosTotales/60);
            $HorasTotales = $hora;
        }
        else
        {
             $hora = ceil($MinutosTotales/60);
             $HorasTotales = $hora;
        }
        
           
           
     
     echo $HoraActual."<br>".$HoraAnterior."<br>".$MinutosTotales."<br>".$HorasTotales;
?>
<?php
function calcular($n){
    return strlen($n);
}

$nombres=array('Candela'=> "se sienta a mi lado",
    "Juanma"=>"este soy yo",
    "Alejadro"=>"se sienta delante de Candela por tanto esta delante mio");
$longitudes=array_map("calcular",$nombres);
asort($longitudes);
echo "Min :  ".$longitudes[array_key_first($longitudes)]. "Max : ". $longitudes[array_key_last($longitudes)]
// funcion max() min()
?>
<?php
$array=["Esto","es","un","array","de","prueba"];
$arrayArray=[];

for($i=1;$i<count($array);$i++){
    $pFrase=implode(" ",array_slice($array,0,$i));
    $sFrase=implode(" ",array_slice($array,$i,count($array)));
    $arrayFusion=[$pFrase,$sFrase];
    $arrayArray[]=$arrayFusion;
}

print_r ($arrayArray);
?>
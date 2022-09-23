<?php
function rand_Pass($upper = 1, $lower = 5, $numeric = 3, $other = 2){
    $caracter = "";

    for( $i=0; $i<$upper ; $i++){
        $caracter .=chr(rand(65,90));       
    }
    for( $i=0; $i<$lower ; $i++){
        $caracter .=chr(rand(97,122));       
    }
    for( $i=0; $i<$numeric ; $i++){
        $caracter .=chr(rand(48,57));       
    }
    for( $i=0; $i<$other ; $i++){
        $caracter .=chr(rand(33,47));       
    }
    $array =str_split($caracter);
    shuffle($array);
    $longitud=(count($array)-1);
    echo (implode("", $array));

}
rand_Pass();
?>

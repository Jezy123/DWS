<?php

function ordenarLongitud($element1,$element2){
    
    if(strlen($element1)<strlen($element2)){
        return -1;
    }else if(strlen($element1)>strlen($element2)){
        return 1;
    }else{
        return 0;
    }

}

$nombres=array('Candela'=> "se sienta a mi lado",
    "Juanma"=>"este soy yo",
    "Alejadro"=>"se sienta delante de Candela por tanto esta delante mio");

uasort($nombres,"ordenarLongitud");
print_r($nombres);
?>
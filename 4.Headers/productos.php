<?php

$productos = ["1" => "Producto 1", "2" => "Producto 2", "3" => "Producto 3"];
$idProducto=$_GET["id"];

if(array_key_exists($idProducto,$productos)){
    echo $productos[$idProducto];
}else{
    if(http_response_code()===200){
        echo "no existe el producto";
    }
}
?>
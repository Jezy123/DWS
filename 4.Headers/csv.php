<?php
$productos = ["1" => "Producto 1", "2" => "Producto 2", "3" => "Producto 3"];
header('Content-Type: application/csv');
header('Content-Disposition:attachment ; filename="productos.csv"');

foreach($productos as $id=>$producto){
   
    echo ($id. ";".$producto."\n");

}

?>
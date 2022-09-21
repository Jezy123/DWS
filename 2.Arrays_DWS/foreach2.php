<?php
$color = array('blanco'=>'blanco.html', 
'verde' => 'verde.html', 
'rojo' => 'rojo.html');
echo "<ul>";
foreach($color as $color=>$url){

    echo "<li><a href='$url'>$color</a></li>";
}
echo "</ul>";

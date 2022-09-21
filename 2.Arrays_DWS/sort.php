<?php
$edades=array("Juan"=>"31","María"=>"41","Andrés"=>"39","Berta"=>"40");



//Por edades
asort($edades);
echo 'por edades : ';
foreach($edades as $nombre=>$edad){
    echo $nombre.' ';
}
?>
<br>
<?php
arsort($edades);
echo 'por edades de forma descendente : ';
foreach($edades as $nombre=>$edad){
    echo $nombre.' ';
}
?>
<br>
<?php
ksort($edades);
echo 'por nombres de forma ascendente : ';
foreach($edades as $nombre=>$edad){
    echo $nombre.' ';
}
?>
<br>
<?php
krsort($edades);
echo 'por nombres de forma descendente : ';
foreach($edades as $nombre=>$edad){
    echo $nombre.' ';
}
?>
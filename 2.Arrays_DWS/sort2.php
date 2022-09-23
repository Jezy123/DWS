<?php
$temperaturas = '12 15 17 19 24 8 7 9';
$tempA=explode(" ", $temperaturas);
asort($tempA);

print_r(array_slice($tempA, 0, 5));
?>
<br>
<?php
arsort($tempA);
print_r(array_slice($tempA,0,5));

$suma= array_sum($tempA);
$cuenta= count($tempA);
echo $suma / $cuenta;
?>
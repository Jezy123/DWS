<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $nombres= array('Alfredo','Pepe','Juanito','Candela','Juanma');
    echo count($nombres);
?>
<br>
<?php
    echo implode(" ",$nombres);
?>
<br>
<?php
    $nombresOrdenados=$nombres;
    asort($nombresOrdenados);
    echo implode(" ",$nombresOrdenados);
?>
<br>
<?php
    $reverse=array_reverse($nombres);
    print_r ($reverse);
?>
<br>
<?php
    $buscar=array_search("Juanma",$nombres);
    echo $buscar;
?>
<?php
    $alumnos= array(
        array(0,"Juama Pérez",21),
        array(1,"Candela Lucena",22),
        array(2,"Alejandro Acosta",18)
    );
    
    echo "<table border=1>";
    echo "<tr>";
    echo "  <th> ".$alumnos[0][0] . "</th>";
    echo "  <th> ".$alumnos[0][1] . "</th>";
    echo "  <th> ".$alumnos[0][2] . "</th>";
    echo "</tr>";
    echo "<tr>";
    echo "  <th> ".$alumnos[1][0] . "</th>";
    echo "  <th> ".$alumnos[1][1] . "</th>";
    echo "  <th> ".$alumnos[1][2] . "</th>";
    echo "</tr>";
    echo "<tr>";
    echo "  <th> ".$alumnos[2][0] . "</th>";
    echo "  <th> ".$alumnos[2][1] . "</th>";
    echo "  <th> ".$alumnos[2][2] . "</th>";
    echo "</tr>";
    echo "</table>";

?>
<br>
<?php
    $columna=array_column($alumnos,1);
    print_r ($columna);
?>  
<br>
<?php
    $numeritos= array(1,2,3,4,5,6,7,8,9,10);
    echo array_sum($numeritos);
?>
</body>
</html>

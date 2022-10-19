<?php

$serverNavegador=strtolower($_SERVER["HTTP_USER_AGENT"]);
echo($serverNavegador);
    //Fin script

    if (strpos($serverNavegador,"firefox")|| strpos($serverNavegador,"google")){

        $content = "Esta viendo la pagina con firefox";

        $title = "felicidades usas firefox";

    }else{

        $content = "No estes usando firefox";

        $title = "Instala firefox para ver el contenido de la pagina";

    }

?>

<!doctype html>

<html lang="es">

<head>

    <meta charset="utf-8">

    <title><?= $title ?></title>

    <meta name="author" content="Víctor Ponz">

</head>    

<body>

    <ul><?= $title ?>

        <li><a href='idioma.php?setLanguage=es'>Español</a></li>

        <li><a href='idioma.php?setLanguage=en'>Inglés</a></li>

    </ul>

    <?= $content ?>

</body>

</html>
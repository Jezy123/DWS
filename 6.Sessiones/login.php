<?php
session_start();

if (isset($_SESSION["username"])){
    echo "hola " . $_SESSION["username"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
    $pdo = new PDO(
        'mysql:host=localhost;dbname=proyecto1;charset=utf8',
        'root',
        'sa',
    $opciones);

    //si esta vacio, el nombre esta disponible
    $sqlN = $pdo->query("SELECT (username) from users where username = '" . $_POST["nombre"]."'")->fetch();

    $sqlE = $pdo->query("SELECT (email) from users where email = '" . $_POST["correo"]. "'")->fetch();

    $sql=("SELECT * from users where  username = '" . $_POST["nombre"]."'");

    if(!empty($sqlN)){

        if(!empty($sqlE)){
            $resultado = $pdo->query($sql);
            print_r($resultado->fetch());
        }else{
            echo("El correo electronico introducido no existe");
        }

    }else{
        echo("el usuario no existe");
    }
}
?>


<html>

<body>
<h2>Login</h2>
<form method="post" enctype="multipart/form-data">

    <p>Nombre de usuario</p>
    <input type="text" name="nombre"  />

    <p>correo electronico</p>
    <input type="text" name="correo"/>

    <input type="submit" name="submit"/>

</form>

</body>

</html>


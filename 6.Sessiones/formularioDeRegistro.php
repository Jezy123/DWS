<?php
session_start();
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

    $sqlE = $pdo->query("SELECT (email) from users where email = '" . $_POST["correo"]. " ' ")->fetch();

   

    if($_POST["password"]==$_POST["repite"]){
        if(empty($sqlN)){
            if(empty($sqlE)){
                $sql="Insert into users (username,email,password) Values("."'" .$_POST["nombre"]."','". $_POST["correo"]."','".$_POST["password"]."'".")";
                $pdo->query($sql);
                $_SESSION["username"] =  $_POST["nombre"];
            }else{
                echo ("El correo ya existe");
            }
        }else{
            echo("El nombre de usuario ya existe");
        }
    }else{
        echo("Las contraseña no es la misma");
    }

    
}
?>
<html>

<body>
<h2>Formulario de registro</h2>
<form method="post" enctype="multipart/form-data">
    <p>Nombre de usuario</p>
    <input type="text" name="nombre"  />

    <p>correo electronico</p>
    <input type="text" name="correo"  />

    <p>contraseña</p>
    <input type="passwword" name="password"  />

    <p>repite la contraseña</p>
    <input type="passwword" name="repite"  />

    <input type="submit" name="submit" />

</form>

</body>

</html>
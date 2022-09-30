<?php

function erroresFuncion(){

   
    if ($nombre==""){
        $errores[]= ("el nombre tiene que contener algo");
    }else if(!preg_match("/^[a-zA-Z]+/", $nombre)){
        $errores[] = "Sólo se permiten letras como nombre de usuario <br>";
    }

    if ($correo=="") {
        $errores[] = "El email es requerido <br>";
    } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $correo)) {
        $errores[] = "Formato de email incorrecto";
    }

    if(empty($avatar)){
        $errores[]="Introduce una foto de avatar";
    }

}

$errores=array();

if(isset($_POST["submit"])){ 
    $nombre = $_POST["nombre"];
    $correo=$_POST ["correo"];
    $estudios=$_POST["estudios"];
    $avatar=$_Post["avatar"]; 
    erroresFuncion();
    if(empty($errores)){?>
    
        <h2>Mostrar datos enviados</h2>

        Nombre : <?= $nombre ?? "" ?> <br>

        Correo : <?= $correo ?? "" ?> <br>

        Estudios : <?= $estudios ?? "" ?> <br>

        Avatar : <?= $avatar ?? ""?> <br>
<?php
    }else{
        print_r ($errores);
    }
}
?>

<html>

<body>
<h2>Formulario subida de archivos</h2>
<form method="post">
    <p>Nombre</p>
    <input type="text" name="nombre"  />

    <p>correo</p>
    <input type="text" name="correo"  />

    <p>Estudios</p>
    <select name="estudios">
        <option value="sin-estudios">Sin estudios</option>
        <option value="educacion-obligatoria">Educación Obligatoria</option>
        <option value="formacion-profesional">Formación profesional</option>
        <option value="universidad">Universidad</option>

    </select> <br>

    <p>Avatar</p>
    <input type="file" name="avatar"  />

    <input type="submit" name="submit" />

</form>

</body>

</html>
<?php


$errores=array();

if(isset($_POST["submit"])){ 
    $nombre = $_POST["nombre"];
    $correo=$_POST ["correo"];
    $estudios=$_POST["estudios"];
    $avatar=$_FILES["avatar"]; 

    $nombreArchivo = $_FILES['avatar']['name'];
    $directorioTemp = $_FILES['avatar']['tmp_name'];
    $extension = $arrayArchivo['extension'];
    $nombreCompleto = $directorioSubida.$nombreArchivo.".".$extension;
    move_uploaded_file($directorioTemp, $nombreCompleto);
    
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
<form method="post" enctype="multipart/form-data">
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
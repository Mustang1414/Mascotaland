<?php
require "../db.php";


if (!empty($_POST["nombres"])) {
  $consulta = "INSERT INTO usuarios (nombre, apellido, contrasena, correo, username) VALUES (:nombres, :apellidos, :contra, :correo, :username)";
  $st = $conn->prepare($consulta);
  $username = strtolower(substr($_POST['nombres'], 0, 3) . substr($_POST['apellidos'], 0, 3));
  $password = password_hash($_POST['contra'], PASSWORD_BCRYPT);
  $st->bindParam(':nombres', $_POST['nombres']);
  $st->bindParam(':apellidos', $_POST['apellidos']);
  $st->bindParam(':contra', $password);
  $st->bindParam(':correo', $_POST['correo']);
  $st->bindParam(':username', $username);
  if ($st->execute()) {
    $message = "succesfully created new user";
  } else {
    $message = "lo siento, ha habido un problema al crear su contraseña";
  }
}

//nombre	apellido	contrasena	correo	

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../login.css">
  <title>Formulario Registro</title>
</head>

<body>
  <div class="login-box">
   
      <form action="registro.php" method="POST">
        <h4>Formulario Registro</h4>
        <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
        <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
        <input class="controls" type="password" name="contra" id="contra" placeholder="Ingrese su Contraseña">
        <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
        <input class="botons" type="submit" value="Registrar">
      </form>

      <p><a href="#">¿Ya tengo Cuenta?</a></p>
    
  </div>
</body>

</html>
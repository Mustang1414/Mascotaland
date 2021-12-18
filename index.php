<?php

session_start();
if (isset($_SESSION['user'])) {
    header('Location: /Mascotaland/home.php');
}
require 'db.php';

//

if (!empty($_POST["id_usuario"]) && !empty($_POST["cont"])) {
    $consulta = 'SELECT ID, correo, contrasena FROM usuarios WHERE correo = :id_usuario';
    $st = $conn->prepare($consulta);
    $st->bindParam(':id_usuario', $_POST['id_usuario']);
    $st->execute();
    $resultado = $st->fetch(PDO::FETCH_ASSOC);

    //count($resultado) > 0 &&


    if (password_verify($_POST['cont'], $resultado['contrasena'])) {


        $_SESSION['user'] = $resultado['ID'];


        header("Location: /Mascotaland/home.php");
    } else {
        $message = 'Disculpa, tus credenciales no son correctas';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">


    <title>Mascotaland</title>
</head>

<body>

   



        <div class="login-box">
            <img src="imagenes/logo.png" class="avatar" alt="Avatar Image">
            <h1>Ingresar Aqui</h1>
            <form action="index.php" method="post">

                <label for="id_usuario">Usuario</label>

                <input type="text" name="id_usuario" id="id_usuario" placeholder="ID Usuario">

                <label for="cont">Contraseña</label>

                <input type="password" name="cont" id="cont" placeholder="Poner Contraseña">

                <input type="submit" value="Ingresar">

                <a href="#">¿Olvidaste tu contraseña perkin?</a><br>

            </form>


            <?php if (!empty($message)) : ?>

                <ul class="text-white">
                    <li>
                        <p> <?= $message ?></p>
                    </li>
                </ul>
            <?php endif; ?>

        </div>
    

</html>
<?php require 'partes/nav.php'; ?>
</body>

</html>
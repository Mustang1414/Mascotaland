<?php


session_start();
require 'db.php';
if (isset($_SESSION['user'])) {
    $consulta = 'SELECT ID, correo, contrasena FROM usuarios WHERE ID = :id_usuario';
    $st = $conn->prepare($consulta);
    $st->bindParam(':id_usuario', $_SESSION['user']);
    $st->execute();
    $results = $st->fetch(PDO::FETCH_ASSOC);

    $user = null;


    if (count($results) > 0) {
        $user = $results;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <?php if (!empty($user)) : ?>
        <ul class="text-white">
            <li>
                Bienvenido: <?= $user['correo']; ?>
                Ya eres parte de nosotros
            </li>
        </ul>

        <div id="mains" class="">
            <a href="paginas/mascotas2.php"><img id="img2" src="imagenes/calleja.jpg" class="h-50 w-50"></a>
        </div>
        <ul class="text-white">
            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>

        </ul>

    <?php else : ?>
        <h1>Please Login or SignUp</h1>

        <a href="login.php">Login</a> or
        <a href="signup.php">SignUp</a>
    <?php endif; ?>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        //$('#img1').click(function(){
        //alert("chupalo");
        // });
        // $('#img2').click(function(){
        //  alert("chupalo");
        // });
    </script>
</body>

</html>
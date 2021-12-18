<?php
require '../db.php';

session_start();


if (isset($_SESSION['user'])) {
  $consulta = 'SELECT ID, correo FROM usuarios WHERE ID = :id_usuario';
  $st = $conn->prepare($consulta);
  $st->bindParam(':id_usuario', $_SESSION['user']);
  $st->execute();
  $results = $st->fetch(PDO::FETCH_ASSOC);

  $user = null;


  if (count($results) > 0) {
    $user = $results;
  }
} else {
  header('Location: /Mascotaland');
}

if (!empty($_GET["ID"])) {
  $consulta = "SELECT * FROM mascotas WHERE ID = :ID";
  $st = $conn->prepare($consulta);
  $st->bindParam(':ID', $_GET["ID"]);
  $st->execute();
  $results = $st->fetch(PDO::FETCH_ASSOC);
  $nombre_mascota = $results['nombre'];
  $tipo_mascota = $results['tipo'];
  $descripcion_mascota = $results['descripcion'];
  $sexo_mascota = $results['sexo'];
  $foto_mascota = $results['foto'];
}

if (!empty($_POST["update"])) {
  $id = $_GET["ID"];
  $consulta = "UPDATE mascotas set nombre = :nombre , tipo = :tipoMascota , descripcion = :descripcion , sexo = :sexo where ID = $id";
  $st = $conn->prepare($consulta);
  $st->bindParam(':nombre', $_POST['nombre']);
  $st->bindParam(':tipoMascota', $_POST['tipoMascota']);
  $st->bindParam(':sexo', $_POST['sexo']);
  $st->bindParam(':descripcion', $_POST['descripcion']);
  $st->execute();
  header('Location: mascotas.php');
}



/* $consulta = "SELECT * FROM mascotas";
$st = $conn->prepare($consulta);
$st->execute(); */
/* $results = $st->fetch(PDO::FETCH_ASSOC); */



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="s_registro.css">
  <link rel="stylesheet" href="../style.css">
  <title>Hotel para mascotas</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">




  <style>
    .row {
      display: flex;
      width: 100%;
    }
  </style>
</head>

<body>
  <ul class="text-white">
    <li>
      Usuario: <?= $user['correo']; ?>
    </li>

  </ul>
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <section>
          <form action="editMascotas.php?ID=<?= $_GET['ID'] ?>" method="POST">
            <h4>Hotel para mascotas</h4>
            <input class="controls" type="text" name="nombre" id="nombre" value="<?php echo $nombre_mascota ?>">
            <label id="tipoMascotaHidden" name="<?php echo $tipo_mascota ?>" hidden><?php echo $tipo_mascota ?></label>
            <select class="controls" name="tipoMascota" id="tipoMascota">
              <option disabled selected>Tipo de mascota</option>
              <option value="perro">Perro</option>
              <option value="gato">Gatos</option>
              <option value="aves">Aves</option>
              <option value="roedores">Roedores</option>
              <option value="peces">Peces</option>
            </select>
            <label id="sexoMascotaHidden" name="<?php echo $sexo_mascota ?>" hidden><?php echo $sexo_mascota ?></label>
            <br>
            <label for="sexo">Macho</label>
            <input class="controls" type="radio" name="sexo" id="macho" value="Macho">
            <label for="sexo">Hembra</label>
            <input class="controls" type="radio" name="sexo" id="hembra" value="Hembra">
            <input class="controls" type="text" name="descripcion" id="descripcion" placeholder="Descripcion de la mascota" value="<?php echo $descripcion_mascota ?>">
            <input class="botons" type="submit" value="update" name="update">
          </form>

        </section>
      </div>
    </div>
  </div>

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script>
    var tipoMascota = $("#tipoMascotaHidden").attr("name");
    $("#tipoMascota option[value=" + tipoMascota + "]").attr("selected", true);

    var sexoMascota = $("#sexoMascotaHidden").attr("name");
    if (sexoMascota == 'Hembra') {
      $("#hembra").prop("checked", true);
    } else if (sexoMascota == 'Macho') {
      $("#macho").prop("checked", true);
    }
    console.log(sexoMascota);

    /* $('#tipoMascotaHidden').click(function(){
      

      alert(tipoMascota);
    }); */
  </script>
</body>


</body>


</html>
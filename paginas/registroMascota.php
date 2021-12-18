<?php
session_start();
require '../db.php';

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
}else{
  header('Location: ../registro.php');
}

if (!empty($_POST["nombre"])) {
  $consulta = "INSERT INTO mascotas (nombre, tipo, sexo, foto, descripcion) VALUES (:nombre, :tipoMascota, :sexo, :foto, :descripcion)";
  $st = $conn->prepare($consulta);
  $st->bindParam(':nombre', $_POST['nombre']);
  $st->bindParam(':tipoMascota', $_POST['tipoMascota']);
  $st->bindParam(':sexo', $_POST['sexo']);
  $st->bindParam(':foto', $_POST['foto']);
  $st->bindParam(':descripcion', $_POST['descripcion']);
  if ($st->execute()) {
    $message = "Mascota ingresada";
  } else {
    $message = "lo siento, Su mascota kla no pudo ser ingresada";
  }
}

$consulta = "SELECT * FROM registros";
$st = $conn->prepare($consulta);
$st->execute();
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
      <div class="col-4">
        <section class="form-register">
          <form action="mascotas.php" method="POST">
            <h4>Adopcion mascotas</h4>
            <input class="controls" type="text" name="nombre" id="nombre" placeholder="">
            <select class="controls" name="tipoMascota" id="tipoMascota">
              <option disabled selected>Tipo de mascota</option>
              <option value="perro">Perro</option>
              <option value="gato">Gatos</option>
              <option value="aves">Aves</option>
              <option value="roedores">Roedores</option>
              <option value="peces">Peces</option>
            </select>
            <label for="sexo">Macho</label>
            <input class="controls" type="checkbox" name="sexo" id="sexo" value="Macho">
            <label for="sexo">Hembra</label>
            <input class="controls" type="checkbox" name="sexo" id="sexo" value="Hembra">
            <input class="controls" type="file" name="foto" id="foto" placeholder="Fotografia de la mascota">
            <input class="controls" type="text" name="descripcion" id="descripcion" placeholder="Descripcion de la mascota">
            <input class="botons" type="submit" value="Guardar">
          </form>

        </section>
      </div>

      <div class="col-8 form-register">



        <section>
          <table class="table">
            <thead class="table-dark">
              <tr>
                <th scope="col">Folio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Sede</th>

              </tr>
            </thead>
            <tbody>
              <?php

              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
              ?>

                <tr class="text-light">
                  <td><?= $row['folio'] ?></td>
                  <td><?= $row['fecha_cita'] ?></td>
                  <td><?= $row['sede'] ?></td>

                  <!-- <td>
                    <a href="edit_task.php?id=<?= $row['id'] ?>" class="btn btn-secondary">
                      <i class="fas fa-marker"></i>
                    </a>
                    <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-danger">
                      <i class="far fa-trash-alt"></i>
                    </a>
                  </td> -->
                </tr>

              <?php

              }
              ?>
            </tbody>
          </table>
        </section>
      </div>
    </div>
  </div>

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


</body>


</html>
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

$valor = "pedro";
$consulta = "SELECT * FROM mascotas WHERE descripcion = :descripcion";
$st = $conn->prepare($consulta);
$st->bindParam(':descripcion', $valor);
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

  <!-- FONT AWESOME 5 -->
  <script src="https://kit.fontawesome.com/529dd4f756.js" crossorigin="anonymous"></script>


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
    <div class="row">
      <div class="col">
        <section class="form-register" >
          <form action="saveMascotas.php" method="POST">
            <h4>Registro Mascotas</h4>
            <input class="controls" type="text" name="nombre" id="nombre" placeholder="Nombre mascota">
            <select class="controls" name="tipoMascota" id="tipoMascota">
              <option disabled selected>Tipo de mascota</option>
              <option value="perro">Perro</option>
              <option value="gato">Gatos</option>
              <option value="aves">Aves</option>
              <option value="roedores">Roedores</option>
              <option value="peces">Peces</option>
            </select>
            <label for="sexo">Macho</label>
            <input class="controls" type="radio" name="sexo" id="macho" value="Macho">
            <label for="sexo">Hembra</label>
            <input class="controls" type="radio" name="sexo" id="hembra" value="Hembra">
            <input class="controls" type="file" name="foto" id="foto" placeholder="Fotografia de la mascota">
            <input class="controls" type="text" name="descripcion" id="descripcion" placeholder="Descripcion de la mascota">
            <input class="botons" type="submit" value="guardar" name="guardar">
          </form>

        </section>
      </div>

      <div class="col">
        <section >
          <h5>Adopcion</h5>
          <table class="table border">
            <thead class="table-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Sexo</th>
                <th scope="col">Foto</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php

              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
              ?>

                <tr class="text-light">
                  <td><?= $row['nombre'] ?></td>
                  <td><?= $row['tipo'] ?></td>
                  <td><?= $row['descripcion'] ?></td>
                  <td><?= $row['sexo'] ?></td>
                  <td><?= $row['foto'] ?></td>
                  <td>
                    <a href="editMascotas.php?ID=<?= $row['ID'] ?>" class="btn btn-secondary">
                      <?= $row['ID'] . " " ?>
                      <i class="fas fa-marker"></i>
                    </a>
                    <a href="deleteMascotas.php?ID=<?= $row['ID'] ?>" class="btn btn-danger">
                      <i class="far fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>

              <?php

              }
              ?>
            </tbody>
          </table>
        </section>
      </div>

      <?php
      $valor = "valor";
      $consulta = "SELECT * FROM mascotas WHERE descripcion = :descripcion";
      $st = $conn->prepare($consulta);
      $st->bindParam(':descripcion', $valor);
      $st->execute();

      ?>
      <div class="col">
        <section>
          <h5>Hotel</h5>
          <table class="table border">
            <thead class="table-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Sexo</th>
                <th scope="col">Foto</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php

              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
              ?>

                <tr class="text-light">
                  <td><?= $row['nombre'] ?></td>
                  <td><?= $row['tipo'] ?></td>
                  <td><?= $row['descripcion'] ?></td>
                  <td><?= $row['sexo'] ?></td>
                  <td><?= $row['foto'] ?></td>
                  <td>
                    <a href="editMascotas.php?ID=<?= $row['ID'] ?>" class="btn btn-secondary">
                      <?= $row['ID'] . " " ?>
                      <i class="fas fa-marker"></i>
                    </a>
                    <a href="deleteMascotas.php?ID=<?= $row['ID'] ?>" class="btn btn-danger">
                      <i class="far fa-trash-alt"></i>
                    </a>
                  </td>
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
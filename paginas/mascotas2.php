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

$valor = "hotel";
$consulta = "SELECT * FROM mascotas WHERE tipo_servicio = :tipo_servicio";
$st = $conn->prepare($consulta);
$st->bindParam(':tipo_servicio', $valor);
$st->execute();
/* $results = $st->fetch(PDO::FETCH_ASSOC); */








?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    <li>
      <a href="../home.php">Atras</a>
    </li>
  </ul>

  <div class="container-fluid">
    <div class="row">
      <section>
        <div class="ups m-2">
          <div class="col rounded p-3 me-3">
            <form action="saveMascotas.php" method="POST" enctype="multipart/form-data">
              <h4 class="text-white">Registro Mascotas</h4>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nombre mascota" name="nombre" id="nombre">
              </div>

              <select class="form-control mb-3" name="tipoMascota" id="tipoMascota">
                <option disabled selected>Tipo de mascota</option>
                <option value="perro">Perro</option>
                <option value="gato">Gatos</option>
                <option value="aves">Aves</option>
                <option value="roedores">Roedores</option>
                <option value="peces">Peces</option>
              </select>

              <div class="form-check checkboxs">
                <input class="form-check-input" type="radio" value="Macho" name="sexo" id="macho">
                <label class="form-check-label text-white" for="sexo"> Macho </label>
              </div>
              <div class="form-check checkboxs mb-3">
                <input class="form-check-input" type="radio" value="Hembra" name="sexo" id="hembra">
                <label class="form-check-label text-white" for="sexo"> Hembra </label>
              </div>

              <div class="input-group mb-3">
                <input type="file" class="form-control" id="foto" name="foto">
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion">
              </div>

              <select class="form-control mb-3" name="tipo_servicio" id="tipo_servicio">
                <option disabled selected>Tipo de servicio</option>
                <option value="hotel">Hotel</option>
                <option value="albergue">Albergue</option>
              </select>


              <input type="submit" value="Guardar" name="guardar" class="botons">
            </form>
          </div>

        </div>

      </section>

      <div class="col rounded p-3 m-3">
        <section>
          <h5 class="text-white">Hotel</h5>
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
                  <td> <img src="../img/<?= $row['foto'] ?>" style="width: 50px; height: 50px; border-radius:150px;"> </td>
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

      $tipo_servicio = "albergue";
      $consulta = "SELECT * FROM mascotas WHERE tipo_servicio = :tipo_servicio";
      $st = $conn->prepare($consulta);
      $st->bindParam(':tipo_servicio', $tipo_servicio);
      $st->execute();

      ?>
      <div class="col rounded p-3 m-3">
        <section>
          <h5 class="text-white">Albergue</h5>
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
                  <td><img src="../img/<?= $row['foto'] ?>" style="width: 50px; height: 50px; border-radius:150px;"></td>
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
    <ul class="text-white">
      <li>
        <a href="../logout.php">
          Logout
        </a>
      </li>

    </ul>
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
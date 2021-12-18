<?php

include('../db.php');

$archivo = $_FILES["foto"];
$extencion = pathinfo($archivo["name"], PATHINFO_EXTENSION);
$imagen = $_POST['nombre'].".".$extencion;
move_uploaded_file($archivo["tmp_name"], "../img/$imagen");


if (isset($_POST['guardar']) && !empty($_POST["nombre"]) && !empty($_POST["tipoMascota"] && $_FILES['foto'])) {
    $consulta = "INSERT INTO mascotas (nombre, tipo, sexo, foto, descripcion, tipo_servicio) VALUES (:nombre, :tipoMascota, :sexo, :foto, :descripcion, :tipo_servicio)";
    $st = $conn->prepare($consulta);
    $st->bindParam(':nombre', $_POST['nombre']);
    $st->bindParam(':tipoMascota', $_POST['tipoMascota']);
    $st->bindParam(':tipo_servicio', $_POST['tipo_servicio']);
    $st->bindParam(':sexo', $_POST['sexo']);
    $st->bindParam(':foto', $imagen);
    $st->bindParam(':descripcion', $_POST['descripcion']);
    $st->execute();
    header('Location: mascotas2.php');
    if (!$st) {

        die("query fail");
    }
}else {
    header('Location: mascotas2.php');
}

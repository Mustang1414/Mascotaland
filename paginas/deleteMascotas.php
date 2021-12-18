<?php
    include('../db.php');

    $id = $_GET['ID'];
    $query = "SELECT foto FROM mascotas WHERE id = $id";
    $st = $conn->prepare($query);
    $st->execute();
    $results = $st->fetch(PDO::FETCH_ASSOC);
    /* $contents = file_get_contents('../img/$'); */
    if (unlink('../img/'.$results["foto"])) {
        // file was successfully deleted
        echo "correctamente borrado";
      } else {
        // there was a problem deleting the file
        echo "hubo un problema al borrarlo";
      }
    


    if(isset($_GET['ID'])){
        
        
        $query =  "DELETE FROM mascotas WHERE id = $id";        
        $st = $conn->prepare($query);
        $st->execute();
        if(!$st){

            die("query fail");
        }

        $_SESSION['message'] = 'task removed succesfully xP';
        $_SESSION['message_type'] = 'danger';

        header('Location: mascotas2.php');
    }
?>
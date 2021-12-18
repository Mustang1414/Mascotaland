<?php
   $server = 'localhost:3307';
   $username = 'root';
   $password = '12345';
   $database = 'mascotaland';
    try {

        $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);


    } catch(PDOException $e){

        die('connected failed: '.$e->getMessage());

    }
?>
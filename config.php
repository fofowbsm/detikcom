<?php

    $host = "localhost";
    $user = "root";
    $pass = "123";
    $db_name = "detikcom_portal_berita";

    try {
        $connect_db = new PDO("mysql:host={$host};dbname={$db_name}",$user,$pass);
        $connect_db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch (PDOException $e){
        echo  $e->getMessage();
    }

    include_once 'class.crud.php';
    $crud = new crud($connect_db);
?>
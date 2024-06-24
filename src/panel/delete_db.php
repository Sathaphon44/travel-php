<?php 
    session_start();
    include "../db/connect.php";

    if (count($_SESSION) == 0){
        header('location: index.php');
    };

    $id = $_REQUEST['idC'];
    $nameImage = $_REQUEST['nameImage'];
    $sql = "DELETE FROM content WHERE id=$id";
    $conn->query($sql);
    $directory = '../images/travel/'.$nameImage;
    unlink($directory);
    header("location: admin.php")
    
?>
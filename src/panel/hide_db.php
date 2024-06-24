<?php
    session_start();
    if (count($_SESSION) == 0){
        header('location: ../index.php');
    };
    
    include '../db/connect.php';
    if ($_REQUEST['hide'] == '0'){
        $id = $_REQUEST['idC'];
        $hide = $_REQUEST['hide'];
        // $sql = "SELECT * FROM content WHERE id='$id'";
        $sql = "UPDATE content SET hide='1' WHERE id=$id";
        $conn->query($sql);
        header('location: admin.php');
    }else{
        $id = $_REQUEST['idC'];
        $hide = $_REQUEST['hide'];
        $sql = "UPDATE content SET hide='0' WHERE id=$id";
        $conn->query($sql);
        header('location: show_hide.php');
    };
?>
<?php

    session_start();
    require('dbconnection.php');

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VowelWeb Admin</title>
    <?php
        require('dbconnection.php');
    ?>
</head>
<style>
    h1, h2{
        width: 100%;
        display: flex;
        justify-content: center;
        /* height: 100%; */
        /* margin-top: 50%; */
    }
</style>
<body>
    <?php
        require('sidebar.php');
    ?>

    <h1>Hello VowelWeb</h1>
    <h2>Admin</h2>
</body>
</html>
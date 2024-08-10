<?php

session_start();

require('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    echo "Email: $username<br>";
    echo "Password: $password<br>";

    $stmt = $con->prepare("SELECT * FROM `adminlogin` WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "No User Found: " . $result->num_rows . "<br>";

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Invalid login credentials";
    }

    $stmt->close();
    $con->close();
}
?>

<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "loginDB";
    $conn = mysqli_connect($host, $username, $password, $db_name);

    if (!$conn) {
        echo "Connection Failed!";
        exit();
    }
?>
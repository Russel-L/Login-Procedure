<?php
    require("connection.php");
    session_start();
    if (isset($_POST['updatepassword'])) {
        echo"clicked";
        $pass = $_POST['password'];
        $update = "UPDATE `login_credentials` SET `password`='$pass',`resettoken`=NULL,`resettokenexpire`=NULL WHERE login_credentials.email='$_POST[email]'";
        if(mysqli_query($conn, $update)) {
            echo"<script>alert('Password Updated Succesfully!'); window.location.href='index.php'</script>";
        }
        else {
            echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";
        }
    }
    else {
        echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";
    }
?>
<?php
    require("connection.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSIGN1-Mercado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1> Password Reset Link from CS 128.1 Mercado-login</h1>

    </header>
    <?php
        if(isset($_SESSION['link']) && $_SESSION['link'] == true) {
            echo"<div class='container'><div class='email' id='email'>
            We got a request from you to reset your password <br> Click the link below: <br> 
            <a href='http://localhost/Mercado-login/updatepassword.php?email=$_SESSION[email]&reset_token=$_SESSION[token]'>Reset Password</a>
            </div>
            </div>";
        }
        ?>
</body>
</html>

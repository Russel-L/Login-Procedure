<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ASSIGN1-Mercado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: antiquewhite;
	        width: 350px;
	        border-radius: 5px;
	        padding: 20px 25px 30px 25px;
        }
        form h3 {
            margin-bottom: 30px;
            color: black;
        }
        form input {
            width: 100%;
	        margin-bottom: 20px;
	        background-color: transparent;
	        border: none;
	        border-bottom: 2px solid black;
	        border-radius: 0;
	        padding: 5px;
	        font-weight: 550;
	        font-size: 14px;
	        outline: none;
        }
        form button {
            font-weight: 550;
            font-style: 18px;
            color: white;
            background-color: maroon;
            padding: 4px 10px;
            border: none;
            outline: none;
            margin-top: 5px;
        }
    </style>

    </head>
    <body>
        <header>
            <h1>Password Update </h1>
        </header>
        <?php
        require("connection.php");
        session_start();

            $query = "SELECT * FROM loginDB.`login_credentials` WHERE login_credentials.email = '$_SESSION[email]' 
            AND login_credentials.resettoken = '$_SESSION[token]'";
            $result = mysqli_query($conn, $query);
            if($result) {
                if(mysqli_num_rows($result) == 1) {
                    echo"<form method='POST' action='newpassword.php'> 
                    <h3> Create New Password </h3>
                    <input type='password' placeholder='New Password' name='password' required>
                    <button type='submit' name='updatepassword'>UPDATE</button>
                    <input type='hidden' name='email' value='$_GET[email]'> 
                    </form>";
                }
                else {
                    echo"<script>alert('Invalid Link!'); window.location.href='index.php'</script>";
                }
            }
            else {
                echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";
            }

        ?>
        <?php
            require("connection.php");

            // if (isset($_POST['updatepassword'])) {
            //     echo"clicked";
            //     $pass = $_POST['password'];
            //     $update = "UPDATE `login_credentials` SET `password`='$pass',`resettoken`=NULL,`resettokenexpire`=NULL WHERE login_credentials.email='$_POST[email]'";
            //     if(mysqli_query($conn, $update)) {
            //         echo"<script>alert('Password Updated Succesfully!'); window.location.href='index.php'</script>";
            //     }
            //     else {
            //         echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";
            //     }
            // }
            // else {
            //     echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";

            // }
        ?>
    </body>
</html>
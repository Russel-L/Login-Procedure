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
        <h1> CMSC 128.1 LAB</h1>
        <h2> Log-in Procedure </h2>
        <?php
        if(isset($_SESSION['logged in']) && $_SESSION['logged in'] == true) {
            echo"<div class='user'>
                $_SESSION[username] - <a href='logout.php'> LOGOUT </a>
            </div>";
        }
        else {
            echo"<div class='sign-in-up'>
            <button type='button' onclick=\"popup('login-popup')\">LOGIN</button>
            <button type='button' onclick=\"popup('register-popup')\">REGISTER</button>
        </div>";
        }
        ?>
    </header>
    <div class="popup-container" id="login-popup">
        <div class="popup">
            <form method="POST" action="login-register.php">
                <h2> 
                    <span> USER LOGIN </span>
                    <button type="reset" onclick="popup('login-popup')">X</button>
                </h2>
                <input type="text" placeholder="Email or Username" name="email_username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" class="login-btn" name="login"> LOGIN </button>
            </form>
            <div class="forgot-btn">
                <button type="button" onclick="forgotPopup()">Forgot Password ?</button>
            </div>
        </div>
    </div>

    <div class="popup-container" id="register-popup">
        <div class="register popup">
            <form method="POST" action="login-register.php">
                <h2> 
                    <span> USER REGISTER </span>
                    <button type="reset" onclick="popup('register-popup')">X</button>
                </h2>
                <input type="text" placeholder="Full Name" name="fullname" required>
                <input type="text" placeholder="Username" name="username" required>
                <input type="text" placeholder="E-mail Address" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <span>Role</span>
                <select class="role" v-model="role" name="role">
                    <option value="admin" name="role">Admin</option>
                    <option value="faculty" name="role">Faculty</option>
                    <option value="student" name="role">Student</option>
                </select>
                <button type="submit" class="register-btn" name="register"> REGISTER </button>
            </form>
        </div>
    </div>

    <div class="popup-container" id="forgot-popup">
        <div class="forgot popup">
            <form method="POST" action="forgotpassword.php">
                <h2> 
                    <span> RESET PASSWORD </span>
                    <button type="reset" onclick="popup('forgot-popup')">X</button>
                </h2>
                <input type="text" placeholder="Email" name="email" required>
                <button type="submit" class="reset-btn" name="send-reset-link"> SEND LINK</button>
            </form>
        </div>
    </div>

    <?php
        if(isset($_SESSION['logged in']) && $_SESSION['logged in'] == true) {
            echo"<h1 style='text-align: center; margin-top: 200px'> YOU ARE NOW LOGGED IN - $_SESSION[username] with role $_SESSION[role]</h1>";
        } 
    ?>
    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            console.log(get_popup);
            if(get_popup.style.display=="flex") {
                get_popup.style.display="none";
            }
            else {
                get_popup.style.display="flex ";
            }
        }
        function forgotPopup() {
            document.getElementById('login-popup').style.display="none";
            document.getElementById('forgot-popup').style.display="flex";
        }
    </script>
</body>
</html>
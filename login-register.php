<?php
require "connection.php";
session_start();

    if(isset($_POST['login'])) {
        $query = "SELECT * FROM loginDB.`login_credentials` WHERE login_credentials.email = '$_POST[email_username]' OR login_credentials.username = '$_POST[email_username]'";
        $result = mysqli_query($conn, $query);

        if($result) {
            if(mysqli_num_rows($result) == 1) {
                $result_fetch=mysqli_fetch_assoc($result);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                if($_POST['password'] == $result_fetch['password']) {
                    $_SESSION['logged in'] = true;
                    $_SESSION['username'] = $result_fetch['username'];
                    $_SESSION['role'] = $result_fetch['role'];
                    header("location: index.php");
                }
                else {
                    echo "<script> alert('Incorrect Password');
                    window.location.href='index.php';
                    </script>";
                }
            }
            else {
                echo "<script> alert('E-mail or Username not registered');
                    window.location.href='index.php';
                    </script>";
            }
        }
        else {
            echo "<script> alert('Cannout run query');
                    window.location.href='index.php';
                    </script>";
        }
    }

    if(isset($_POST['register'])) {
        $user_exist_query = "SELECT * FROM loginDB.`login_credentials` WHERE login_credentials.email = '$_POST[email]' OR login_credentials.username = '$_POST[username]'";
        $result = mysqli_query($conn, $user_exist_query);
        #email exists
        if($result) {
            # error for already registered user
            if(mysqli_num_rows($result) > 0) {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['username'] == $_POST['username']) {
                    echo "<script> alert('Usernamer already taken');
                    window.location.href='index.php';
                    </script>";
                }
                else {
                    echo "<script> alert('E-mail already taken');
                    window.location.href='index.php';
                    </script>";
                }
            }
            # no one has taken email or username
            else {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $query = "INSERT INTO `login_credentials`(`fullname`, `username`, `email`, `password`, `role`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$_POST[password]','$_POST[role]')";
                if(mysqli_query($conn, $query)) {
                    echo "<script> alert('Registration Successful');
                    window.location.href='index.php';
                    </script>";
                }
                else {
                    echo "<script> alert('Cannout run query');
                    window.location.href='index.php';
                    </script>";
                }
            }
        }
        else {
            echo "<script> alert('Cannout run query');
            window.location.href='index.php';
            </script>";
        }
    }



?>
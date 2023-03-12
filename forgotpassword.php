<?php
    require("connection.php");
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // function sendMail($email, $reset_token) {
    //     require('PHPMailer/PHPMailer.php');
    //     require('PHPMailer/SMTP.php');
    //     require('PHPMailer/Exception.php');
    //     $mail = new PHPMailer(true);
    //     try {
    //         //Server settings
    //         $mail->isSMTP();                                            //Send using SMTP
    //         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //         $mail->Username   = '128testemail@gmail.com';                     //SMTP username
    //         $mail->Password   = 'testingemail';                               //SMTP password
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //         $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
    //         //Recipients
    //         $mail->setFrom('128testingemail@gmail.com', 'Mailer');
    //         $mail->addAddress($email);     //Add a recipient
        
        
    //         //Content
    //         $mail->isHTML(true);                                  //Set email format to HTML
    //         $mail->Subject = 'Password Reset Link from CS 128.1 Mercado-login';
    //         $mail->Body    = "We got a request from you to reset your password <br> Click the link below: <br> 
    //         <a href='http://localhost/password recovery system/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
    //         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
    //         $mail->send();
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }
    if(isset($_POST['send-reset-link'])) {
        $query = "SELECT * FROM loginDB.`login_credentials` WHERE login_credentials.email = '$_POST[email]'";
        $result = mysqli_query($conn, $query);
        if($result) {
            if(mysqli_num_rows($result)==1) {
                $reset_token = bin2hex(random_bytes(16));
                date_default_timezone_set("Asia/singapore");
                $date = date("Y-m-d");
                $email = $_POST['email'];
                $query = "UPDATE `login_credentials` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE login_credentials.email = '$_POST[email]'";
                if(mysqli_query($conn, $query) ) {
                    echo"<script>alert('Password Reset Link sent to mail'); window.location.href='index.php'</script>";
                    $_SESSION['link'] = true;
                    $_SESSION['token'] = $reset_token;
                    $_SESSION['date'] = $date;
                    $_SESSION['email'] = $email;
                    header("location: email.php");
                }
                else {
                    echo"<script>alert('Server down! Try again later!'); window.location.href='index.php'</script>";
                }
            }
            else {
                echo"<script>alert('E-mail not found'); window.location.href='index.php'</script>";
            }
        }
        else {
            echo"<script>alert('cannot run query'); window.location.href='index.php'</script>";
        }
    }
?>
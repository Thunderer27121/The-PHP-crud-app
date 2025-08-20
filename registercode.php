<?php
session_start();
require "connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = getenv("SMTP_HOST");                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = getenv("SMTP_USER");                     //SMTP username
        $mail->Password   = getenv("SMTP_PASS");              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      //Enable implicit TLS encryption
        $mail->Port       = getenv("SMTP_PORT");      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPDebug = 2; // Or 3 for more details
        $mail->Debugoutput = 'html';
        //Recipients
        $mail->setFrom(getenv("SMTP_USER"));
        $mail->addAddress("$email", "$name");
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'email verification from platform';
        $mail->Body    = "<h2>You have registered with platform</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br><br>
        <a href= 'http://localhost/crud/verify_email.php?token=$verify_token'>click me</a>";


        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $phone =  $_POST['phone'];
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $cpass = $_POST['cpass'];
    $verify_token = md5(rand());
    if (!empty($name) || !empty($phone) || !empty($email) || !empty($password) || !empty($cpass)) {
        if ($password != $cpass) {
            $_SESSION['status'] = "Password and Confirm Password should contain same value";
            echo "
         <script>
         window.location.href = 'register.php';
         </script>
         ";
        } else {
            $check = "SELECT `email` FROM `users` WHERE `email` = '{$email}' LIMIT 1";
            $data = mysqli_query($con, $check);
            if (mysqli_num_rows($data) > 0) {
                $_SESSION['status'] = "email already exists";
                echo "
        <script>
        window.location.href = 'register.php';
        </script>
        ";
            } else {
                $sql = "INSERT INTO users(name,phone,email,password,verify_token) VALUES ('{$name}','{$phone}','{$email}','{$password}','{$verify_token}')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    sendemail("$name", "$email", "$verify_token");
                    $_SESSION['status'] = "registration successful, now please verify your email";
                    echo "
            <script>
            window.location.href = 'register.php';
            </script>
            ";
                } else {
                    $_SESSION['status'] = "registration failed";
                    echo "
            <script>
            window.location.href = 'register.php';
            </script>
            ";
                }
            }
        }
    } else {
        $_SESSION['status'] = "All fields are mandatory";
        echo "
            <script>
            window.location.href = 'register.php';
            </script>
            ";
    }
}

<?php
session_start();
require "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function resend_email($name,$email,$verify_token){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'anujsingh27121@gmail.com';                     
        $mail->Password   = 'iujulevyrjulcgau';                              
        $mail->SMTPSecure = "ssl";          
        $mail->Port       = 465;                                   

        //Recipients
        $mail->setFrom('anujsingh27121@gmail.com');
        $mail->addAddress("$email", "$name");
        $mail->isHTML(true);                                 
        $mail->Subject = 'email verification from platform';
        $mail->Body    = "<h2>Another link to verify your email</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br><br>
        <a href= 'http://localhost/crud/verify_email.php?token=$verify_token'>click me</a>";


        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if(isset($_POST['resend'])){
    if(!empty(trim($_POST['email']))){
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $chek_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $data = mysqli_query($con,$chek_query);
        if(mysqli_num_rows($data)>0){
          $row = mysqli_fetch_array($data);
          if($row['verify_status']==0){
            $name = $row['name'];
            $email = $row['email'];
            $verify_token = $row['verify_token'];
             resend_email($name,$email,$verify_token);
             $_SESSION['status'] = "verification link has been sent to your email address";
             echo "
             <script>
             window.location.href = 'login.php';
             </script>
             ";
             exit(0);
          }else{
            $_SESSION['status'] = "Email is already verified please login";
            echo "
            <script>
            window.location.href = 'login.php';
            </script>
            ";
          }
        }else{
            $_SESSION['status'] = "Email is not registered";
            echo "
            <script>
            window.location.href = 'register.php';
            </script>
            ";
            exit(0);
        }
    }else{
        $_SESSION['status'] = "Enter your email first";
        echo "
        <script>
        window.location.href = 'resend_email.php.php';
        </script>
        ";
        exit(0);
    }
}
?>

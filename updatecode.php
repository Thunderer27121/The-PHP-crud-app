<?php
require 'connect.php';
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
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'anujsingh27121@gmail.com';                     //SMTP username
        $mail->Password   = 'iujulevyrjulcgau';                               //SMTP password
        $mail->SMTPSecure = "ssl";            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('anujsingh27121@gmail.com');
        $mail->addAddress("$email", "$name");
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'email verification from platform';
        $mail->Body    = "<h2>You have Updated your information with platform</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br><br>
        <a href= 'http://localhost/crud/verify_email.php?token=$verify_token'>click me</a>";


        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['updatenow'])) {
    $name =  $_POST['name'];
    $phone =  $_POST['phone']; 
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $verify_token = md5(rand());

        $id = $_POST['id'];
        $sql = "UPDATE `users` SET `name`='{$name}',`phone`='{$phone}',`email`='{$email}',`password`='{$password}',`verify_token`='{$verify_token}',`verify_status`= 0 WHERE `id` = $id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            sendemail("$name", "$email", "$verify_token");
            $_SESSION['status'] = "Updation successful, Now go to your mails and verify your email";
            echo "
            <script>
            window.location.href = 'login.php';
            </script>
            ";
        } else {
            $_SESSION['status'] = "Updation failed";
            echo "
            <script>
            window.location.href = 'update.php';
            </script>
            ";
        }
    }
?>
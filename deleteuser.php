<?php
require "connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail($name, $email)
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
        $mail->Subject = 'User `{$name}` removed from platform';
        $mail->Body    = "<h2>You have been removed from platform</h2>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = $con->prepare("delete from users where id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    if ($sql->affected_rows > 0) {
        echo "<script>
               window.alert('User data deleted');
               window.location.href = 'userdata.php';
              </script>
       ";
        sendemail($name, $email);
    } else {
        echo "<script>
               window.alert('failed to delete data');
               window.location.href = 'userdata.php';
              </script>";
    }
}

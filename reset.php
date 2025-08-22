<?php
session_start();
require 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function password_reset($name, $email, $token)
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
        $mail->Body    = "<h2>Hey there!!</h2>
        <h5>below is the password reset link for your account</h5>
        <br><br>
        <a href= 'https://the-php-crud-app.onrender.com/changepass.php?token=$token&email=$email'>Click me</a>";


        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['resetpass'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());
    $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $data = mysqli_query($con, $check_email);
    if (mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $update = "UPDATE users SET verify_token = '$token' where email = '$email' LIMIT 1";
        $run = mysqli_query($con, $update);
        if ($run) {
            password_reset($name, $email, $token);
            $_SESSION['status'] = "we have sent an email to your id to reset password";
            echo "
          <script>
      window.location.href = 'password_reset.php';
  </script>
          ";
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong";
            echo "
        <script>
    window.location.href = 'password_reset.php';
</script>
        ";
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No email found";
        echo "
        <script>
    window.location.href = 'password_reset.php';
</script>
        ";
        exit(0);
    }
}
?>




<?php
if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']);
    $token = mysqli_real_escape_string($con, $_POST['token']);
    if (!empty($token)) {
        if (!empty($email) && !empty($pass) && !empty($cpass)) {
            $check_token = "SELECT verify_token FROM users WHERE verify_token = '$token' LIMIT 1";
            $newdata = mysqli_query($con, $check_token);
            if (mysqli_num_rows($newdata) > 0) {
                if ($pass == $cpass) {
                    $updatepass = "UPDATE users SET password = '$pass' WHERE verify_token = '$token' LIMIT 1";
                    $newpassdata = mysqli_query($con, $updatepass);
                    if ($newpassdata) {
                        $_SESSION['status'] = "Password updated successfully";
                        echo "
                    <script>
                window.location.href = 'login.php';
            </script>
                    ";
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Unknown error occured";
                        echo "
                    <script>
                window.location.href = 'changepass.php?token=$token&email=$email';
            </script>
                    ";
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Password and confirm password does not match";
                    echo "
            <script>
        window.location.href = 'changepass.php?token=$token&email=$email';
    </script>
            ";
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid token";
                echo "
            <script>
        window.location.href = 'changepass.php?token=$token&email=$email';
    </script>
            ";
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All fields are mandatory";
            echo "
        <script>
    window.location.href = 'changepass.php?token=$token&email=$email';
</script>
        ";
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No token found";
        echo "
        <script>
    window.location.href = 'changepass.php';
</script>
        ";
        exit(0);
    }
}
?>

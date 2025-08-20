<?php
session_start();
require 'connect.php';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT verify_token , verify_status from users where verify_token = '$token'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data)) {
        $row = mysqli_fetch_assoc($data);
        $status = $row['verify_status'];
        if ($status == 1) {
            $_SESSION['status'] = 'email is already verified please login';
            echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
            exit(0);
        } else {
            $clicked_token = $row['verify_token'];
            $update = "UPDATE users SET verify_status = '1' WHERE verify_token='$clicked_token'";
            $updatedata = mysqli_query($con, $update);
            if ($updatedata) {
                $_SESSION['status'] = "you have successfully verified your email now please login";
                echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
                exit(0);
            } else {
                $_SESSION['status'] = "verification failed";
                echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
                exit(0);
            }
        }
    } else {
        $_SESSION['status'] = "this token does not exists";
        echo "
        <script>
        window.location.href = 'register.php';
        </script>
        ";
    }
}

<?php
session_start();
require "connect.php";
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $con->prepare("select * from admin where email = ? and password = ?;");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    if ($result) {
        $_SESSION['admin'] = [
            "Admin_name" => $result['name'],
            "Admin_email" => $result['email'],
            "Admin_id" => $result['id'],
            "Admin_contact" => $result['contact']
        ];
        echo "
        <script>
    window.location.href = 'adminpage.php';
</script>";
    } else {
        $_SESSION['status'] = "Invalid details! Enter Valid details";
        echo "
        <script>
    window.location.href = 'adminLogin.php';
</script>
        ";
    }
}

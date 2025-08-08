<?php
session_start();
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    $_SESSION['status'] = "Logged out successfully, login again to see admin panel";
    echo "
    <script>
      window.location.href = 'adminLogin.php';
    </script>
    ";

}
?>


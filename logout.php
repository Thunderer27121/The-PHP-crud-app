<?php
session_start();
unset($_SESSION['auth_user']);
unset($_SESSION['authentication']);
$_SESSION['status'] = "You've logged out successfully";
echo "<script>
    window.location.href = 'login.php';
</script>";
?>
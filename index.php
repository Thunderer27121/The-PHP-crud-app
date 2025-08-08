<?php
session_start();
$page_title  = "Home page";
unset($_SESSION['admin']);
include('includes/header.php');
include('includes/navbar.php')
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>CRUD Application system</h1>
                <h2>with email verification</h2>
                <div class="card shadow" style="width: 40%; margin: auto;">
                    <div class="card-header">Choose Below</div>
                    <div class="card-body">
                        <a href="login.php">Login As User</a><br>
                        OR <br>
                        <a href="register.php">Register As User</a>
                        <br>
                        <br>
                        <strong>Or</strong>
                        <br>
                        <a href="adminLogin.php">Login As Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>


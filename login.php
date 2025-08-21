<?php
session_start();
$page_title = "login page";
require 'includes/header.php';
require 'includes/navbar.php';
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                        <div class="alert alert-success">
                            <h5> <?= $_SESSION['status']; ?> </h5>
                        </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Login form</h5>
                        </div>
                        <div class="card-body">
                            <form action="logincode.php" method="post" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                </div>
                                <div class="info" style="display:flex; align-items:center; justify-content:space-between">
                                    <span>Didn't get notification? <a href="resend_email.php">resend verification email</a></span>

                                    <a href="password_reset.php">Forgot password</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

require 'includes/footer.php';
?>
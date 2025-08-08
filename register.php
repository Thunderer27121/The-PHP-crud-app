<?php
session_start();
$page_title  = "Registration page";
require 'includes/header.php';
require 'includes/navbar.php';
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert">
                    <?php
                    if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-success">
                        <h5><?=$_SESSION['status']?></h5>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                    }
                    ?>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Registration form</h5>
                    </div>
                    <div class="card-body">
                        <form action="registercode.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Confrim-Password</label>
                                <input type="text" name="cpass" class="form-control">
                            </div>
                            <div class="form-group mb-3 ">
                                <button type="submit" class="btn btn-primary" name=submit>Register now</button>
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
<?php
session_start();
$page_title = "Password update";
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert alert-success">
                        <h5> <?= $_SESSION['status']; ?></h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h5>Fill the details</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="reset.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>" name="token">
                            <div class="form-group mb-3">
                              <label for="email">Email</label>
                              <input type="email" name="email" class="form-control " value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>">
                            </div>
                            <div class="form-group mb-3">
                            <label for="password">New Password</label>
                            <input type="password" name="pass" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="cpass">Confirm password</label>
                            <input type="password" name="cpass" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <input type="submit" name="reset" class="btn btn-primary" value="Reset Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>
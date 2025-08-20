<?php
session_start();
$page_title = "password reset page";
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 ">
                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>password reset form</h5>
                    </div>
                    <div class="card-body">
                        <form action="reset.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="email">Enter your email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit" name="resetpass">Reset password</button>
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
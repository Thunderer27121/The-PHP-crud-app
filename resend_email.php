<?php
$page_title = "Email-resend";
session_start();
include("includes/header.php");
include("includes/navbar.php");

?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                  <?php
                  if(isset($_SESSION['status'])){
                  ?>
                  <div class="alert alert-success">
                    <h5> <?=$_SESSION['status'];?> </h5>
                  </div>
                  <?php
                   unset($_SESSION['status']);
                  }
                  ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Resend email</h5>
                    </div>
                    <div class="card-body">
                        <form action="resend_verify.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary" name="resend">Resend</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("includes/footer.php");
?>
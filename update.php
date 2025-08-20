<?php
session_start();
require 'connect.php';
$email = $_POST['email'];
$sql = "SELECT `id`, `name`, `phone`, `email`, `password` FROM `users` WHERE email = '{$email}'";
$run_query = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($run_query);
require 'includes/header.php';
require 'includes/navbar.php';
$_SESSION['status'] = "Update your information"
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
                        <h5>Update Your Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="updatecode.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $data['name'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone number</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $data['phone'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $data['email'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $data['password'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Confrim-Password</label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>">
                                <input type="text" name="cpass" class="form-control" value="<?php echo $data['password'] ?>">
                            </div>
                            <div class="form-group mb-3 ">
                                <button type="submit" class="btn btn-primary" name='updatenow'>Update now</button>
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
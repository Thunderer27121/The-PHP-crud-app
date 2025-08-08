<?php
session_start();
if (!isset($_SESSION['authentication'])) {
    $_SESSION['status']  = "please login first to access dashboard";
    echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
    exit(0);
} else {
    $page_title  = "Dashboard page";
    include('includes/header.php');
    include('includes/navbar.php');
}
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <div class="card">
                    <div class="card-header">
                        <h5>User dashboard</h5>
                    </div>
                    <div class="card-body">
                        <h5>Access when you are logged in</h5>
                        <hr>
                        <h5>Username: <?php echo $_SESSION['auth_user']['username']?></h5>
                        <h5>Phone: <?php echo $_SESSION['auth_user']['phone']?></h5>
                        <h5>Email: <?php echo $_SESSION['auth_user']['email']?></h5>
                        <form action="mainhandle.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $_SESSION['auth_user']['email']?>" name="email">
                        <button style="color: white; background-color: black;" name="update" type="submit">Update data</button>
                        <button style="color: white; background-color: black;" name="delete" type="submit">Delete data</button>
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
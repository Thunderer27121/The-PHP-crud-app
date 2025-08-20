<?php
session_start();
$page_title = "Admin page";
require "includes/header.php";
require "includes/navbar2.php";
?>
<div class="py-5 mx-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
               <div class="card">
                <div class="card-header">
                    <h2>ADMIN DETAILS</h2>
                </div>
                <div class="card-body">
                   <h4>ID: =><?= $_SESSION['admin']['Admin_id']?></h4>
                   <h4>Name: =><?= $_SESSION['admin']['Admin_name']?></h4>
                   <h4>Contact: =><?= $_SESSION['admin']['Admin_contact']?></h4>
                   <h4>E-Mail: =><?= $_SESSION['admin']['Admin_email']?></h4>
                   <br><br>
                   <form action="userdata.php" enctype="multipart/form-data" method="post">
                    <h5>Click to see the details of users</h5>
                    <button type="submit" name="click" style="background-color: black; color:white;">See all users data</button>
                   </form>
                </div>
               </div> 
            </div>
        </div>
    </div>
</div>
<?php
require "includes/footer.php";
?>
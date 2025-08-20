<div class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Platform</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="index.php">Home</a>
                                </li>
                                <?php
                                if(isset($_SESSION['admin'])){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="adminpage.php">Admin info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="userdata.php">See all users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="adminlogout.php">Logout</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

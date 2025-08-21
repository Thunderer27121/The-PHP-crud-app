<?php
session_start();
$page_title = "login page";
require 'includes/header.php';
require 'includes/navbar.php';
?>
<?php
require_once './googleauth/vendor/autoload.php';

// init configuration
$clientID = '652446713334-h313ajnn1rjdo51r4rhoegncrvukm2dl.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://the-php-crud-app.onrender.com/login.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google\Service\Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Your information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="">Name: <?php echo $name ?></label>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Account: <?php echo $email ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
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
                                    <a href="<?php echo $client->createAuthUrl()?>"><div class="btns" style="height:40px; width:200px; background-image:url('./img//google-signin-button-1024x260.png'); background-size:cover; background-repeat:no-repeat;"></div></a>
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
}
require 'includes/footer.php';
?>
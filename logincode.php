<?php
session_start();
include('connect.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password)){
       $login = "SELECT * FROM users WHERE email = '$email' AND password = '$password' limit 1";
       $data = mysqli_query($con,$login);
       if(mysqli_num_rows($data)>0){
          $row = mysqli_fetch_assoc($data);
          $status = $row['verify_status'];
          if($status==0){
             $_SESSION['status'] = "email not verified, verify to login";
             echo "
             <script>
             window.location.href = 'login.php';
             </script>
             ";
                 exit(0);
          }else{
             $_SESSION['authentication'] = true;
             $_SESSION['auth_user'] = [
                'username'=> $row['name'],
                'phone' => $row['phone'],
                'email' => $row['email']
             ];
            $_SESSION['status'] = "you are logged in successfully";
            echo "
        <script>
        window.location.href = 'dashboard.php';
        </script>
        ";
            exit(0);
          }
       }else{
        $_SESSION['status'] = "Invalid email or password";
        echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
            exit(0);
       }
    }
    else{
        $_SESSION['status'] = "All fields are mandatory";
        echo "
        <script>
        window.location.href = 'login.php';
        </script>
        ";
            exit(0);
    }
}
 
?>
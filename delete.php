<?php
session_start();
require 'connect.php';
if(isset($_POST['delete'])){
    $email = $_POST['email'];
$sql = "delete from users where email = '$email'";
$query = mysqli_query($con,$sql);
if($query){
echo "
<script>
window.location.href = 'logout.php';
alert('data deleted');
</script>
";
}

}
?>

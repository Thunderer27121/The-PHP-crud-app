<?php
$host = getenv("db_host");
$port = getenv("port");
$user = getenv("user");
$pass = getenv("pass");
$db_name = getenv("db_name");

$con = mysqli_connect($host,$user,$pass,$db_name,$port);
if(!$con){
    die('unable to connect').mysqli_error($con);
}
?>

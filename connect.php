<?php
$db_host = "mysql-66d3913-anujsingh27121-bc28.f.aivencloud.com";
$port = 27976;
$db_name = "defaultdb";
$user = "avnadmin";
$pass = "AVNS_g6Lw4jYfacT3mZPvA2L";
$con = mysqli_connect($db_host,$user,$pass,$db_name,$port);
if(!$con){
    die('unable to connect').mysqli_error($con);
}
?>

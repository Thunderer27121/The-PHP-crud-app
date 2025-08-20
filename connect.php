<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$host   = $_ENV['db_host'];
$port   = (int)$_ENV['port'];
$user   = $_ENV['user'];
$pass   = $_ENV['pass'];
$dbname = $_ENV['db_name'];

$con = mysqli_connect($db_host,$user,$pass,$db_name,$port);
if(!$con){
    die('unable to connect').mysqli_error($con);
}
?>

<?php
if(isset($_POST['update'])){
    require 'update.php';
}elseif (isset($_POST['delete'])) {
    require 'delete.php';
}
?>
<?php
session_start();
include "../src/php/config.php";
$id = $_GET['id'];

$qry = mysqli_query(Config::dbConnect(), "UPDATE  appointments SET status = 'approved' WHERE id = '$id';");
header("location:./");


 ?>

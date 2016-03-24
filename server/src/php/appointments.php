<?php
include "config.php";
header("Content-Type : application/json");

$patient = $_GET['patientName'];
$doctor= $_GET['doctorName'];
$moment = strtotime($_GET['moment']);
$status = "pending";
$qryGetPat = mysqli_query(Config::dbConnect(), "SELECT id FROM patients WHERE username = '$patient';");
$user = mysqli_fetch_assoc($qryGetPat)['id'];
$qryGetDoc = mysqli_query(Config::dbConnect(), "SELECT id FROM doctors WHERE name = '$doctor';");
$doc = mysqli_fetch_assoc($qryGetDoc)['id'];


$qry = mysqli_query(Config::dbConnect(), "INSERT INTO appointments (id, doctor, patient, moment, status) VALUES ('', '$doc', '$user', '$moment', '$status');");
if($qry) print "1";
else print "0";
 ?>

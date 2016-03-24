<?php
include "config.php";
header('Content-Type : application/json');
$disease = $_GET['disease'];
$qry = mysqli_query(Config::dbConnect(), "SELECT doctors.id, doctors.name as doctorName, doctors.otherDetails, diseases.name as disease, hospitals.name as hospital FROM doctors INNER JOIN hospitals ON hospitals.id = doctors.hospital INNER JOIN diseases ON doctors.specialization = diseases.id WHERE diseases.name = '$disease';");
$data = array();
while($row = mysqli_fetch_assoc($qry)) {
  $data[] = $row;
}
$data = array("disease" => $data);
print json_encode($data);

 ?>

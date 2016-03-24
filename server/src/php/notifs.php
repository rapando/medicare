<?php
include "config.php";
$patient = $_GET['patientName'];
$qryGetPat = mysqli_query(Config::dbConnect(), "SELECT id FROM patients WHERE username = '$patient';");
$patId = mysqli_fetch_assoc($qryGetPat)['id'];

$qryApp = mysqli_query(Config::dbConnect(), "SELECT appointments.id, doctors.name as doctor FROM appointments INNER JOIN doctors ON doctors.id = appointments.doctor WHERE appointments.patient = '$patId' ORDER BY appointments.id ASC;");

$apps = array();
while($row = mysqli_fetch_assoc($qryApp)) {
  $apps[] = $row;
}

$qryPres = mysqli_query(Config::dbConnect(), "SELECT patientPrescription.id, patientPrescription.prescription, patientPrescription.dosage, doctors.name as doctor FROM patientPrescription INNER JOIN doctors ON doctors.id = patientPrescription.doctor WHERE patientPrescription.patient = '$patId'; ");
$pres = array();
while($row = mysqli_fetch_assoc($qryPres)) {
  $pres[] = $row;
}

$data = array("data" => array("apps" => $apps, "pres" => $pres));
print json_encode($data);
 ?>

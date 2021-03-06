<?php
if(isset($_POST['req'])) {
  include "config.php";
  header('Content-Type : application/json');

  switch($_POST['req']) {
    // ad a doctor

    case 'docLogin':
    docLogin();
    break;

    case 'addDoc':
      addDoc();
    break;

    case 'addPatient':
      addPatient();
    break;

    case 'patientLogin':
      patientLogin();
    break;

    case 'bookAppointment':
      bookAppointment();
    break;

    case 'viewDoctors':
    viewDoctors();
    break;

    case 'viewDoctor':
    viewDoctors();
    break;

    case 'viewDocByDisease':
      viewDocByDisease($_POST['disease']);
    break;

    case 'viewHospitals':
      viewHospitals();
    break;

    case 'viewHospital':
      viewHospital();
    break;

    case 'viewPharmacies':
      viewPharmacies();
    break;

    case 'viewPharmacy':
      viewPharmacy();
    break;

    case 'pharmMedics':
      pharmMedics($_POST['pharmacyName']);
    break;

    case 'viewDisease':
    viewDisease();
    break;

    case 'addPrescription':
    addPrescription();
    break;


  }
} else print "no request";

function docLogin() {
  $username = strtolower(trim($_POST['uname']));
  $pass     = $_POST['pass'];
  $qryUname = mysqli_query(Config::dbConnect(), "SELECT id, username FROM doctors WHERE username = '$username';");
  $no       = mysqli_num_rows($qryUname);
  if ($no > 0) {
    $qryPass    = mysqli_query(Config::dbConnect(), "SELECT id, pass, salt, specialization FROM doctors WHERE username = '$username';");
    $stored     = mysqli_fetch_assoc($qryPass);
    $storedPass = $stored['pass'];
    $storedSalt = $stored['salt'];
    if (Config::passHasher($pass, $storedSalt) == $storedPass) {
      session_start();
      $_SESSION['docid'] = $stored['id'];
      $_SESSION['specialization'] = $stored['specialization'];
      print json_encode(1);
    } else {
      print json_encode(0);

    }
  } else {
    print json_encode(0);
  }
}

function addDoc() {
  $fullName = trim(ucwords($_POST['docFullName']));
  $uname = trim(strtolower($_POST['docUname']));
  $phone = trim($_POST['docPhone']);
  $salt = Config::saltGenerator();
  $pass = Config::passHasher($_POST['docPass'], $salt);
  $specialization = $_POST['docSpecialization'];
  $hospital = $_POST['docHospital'];
  $about = trim($_POST['aboutDoc']);
  $profpic = $_FILES['profPic'];
  $profpicName = $uname."_".basename($profpic['name']);
  $profpicTmpname = $profpic['tmp_name'];

  if(move_uploaded_file($profpicTmpname, "../../files/profiles/$profpicName")) {
    $qry = mysqli_query(Config::dbConnect(), "INSERT INTO doctors (id, name, specialization, hospital, username, pass, salt, otherDetails, image) VALUES ('', '$fullName', '$specialization', '$hospital', '$uname', '$pass', '$salt', '$about', '$profpicName');");
    if($qry) {
      print  "Congratulations. You can now login";
      header("refresh:2; url=../../");
    } else {
      print "Oops, There was a problem creating your accout. Contact the Admin for more details";
    }
  }
}

function addPatient() {
  $email = trim(strtolower($_POST['email']));
  $uname = trim(strtolower($_POST['uname']));
  $salt = Config::saltGenerator();
  $pass = Config::passHasher($_POST['pass'], $salt);

  $qry = mysqli_query(Config::dbConnect(), "INSERT INTO patients (id, email, username, diseases, pass, salt) VALUES ('', '$email', '$uname', '0', '$pass', '$salt');");
  if($qry) print "1";
  else print "0";
}

function patientLogin() {
  $uname = trim(strtolower($_POST['uname']));
  $pass = $_POST['pass'];
  $qryUname = mysqli_query(Config::dbConnect(), "SELECT * FROM patients WHERE username = '$uname';");
  $no = mysqli_num_rows($qryUname);
  if($no > 0) {
    $qryPass = mysqli_query(Config::dbConnect(), "SELECT pass, salt FROM patients WHERE username = '$uname';");
    $stored     = mysqli_fetch_assoc($qryPass);
    $storedPass = $stored['pass'];
    $storedSalt = $stored['salt'];
    if (Config::passHasher($pass, $storedSalt) == $storedPass) {

      print "1";
    } else {
      print "0";
    }
  } else print "Wrong credentials";
}

function bookAppointment() {
  $user = $_POST['user'];
  $doc = $_POST['doc'];
  $moment = $_POST['moment'];
  $status = "pending";
  $qry = mysqli_query(Config::dbConnect(), "INSERT INTO appointments (id, doctor, patient, moment, status) VALUES ('', '$doc', '$user', '$moment', '$status');");
  if($qry) print "1";
  else print "0";
}

function viewDoctors() {
  $qry = mysqli_query(Config::dbConnect(), "SELECT doctors.id, doctors.name as doctorName, doctors.otherDetails, diseases.name as disease, hospitals.name as hospital FROM doctors INNER JOIN hospitals ON hospitals.id = doctors.hospital INNER JOIN diseases ON doctors.specialization = diseases.id  ORDER BY doctors.name ASC;");
  $data = array();
  while($row = mysqli_fetch_assoc($qry)) {
    $data[] = $row;
  }
  $data = array("disease" => $data);
  print json_encode($data);
}

function viewDoctor() {
  $docId = $_POST['docId'];

  $qry = mysqli_query(Config::dbConnect(), "SELECT doctors.id, doctors.name as doctorName, doctors.otherDetails, diseases.name as disease, hospitals.name as hospital FROM doctors INNER JOIN hospitals ON hospitals.id = doctors.hospital INNER JOIN diseases ON doctors.specialization = diseases.id WHERE doctors.id = '$docId';");
  $data = array("doctor" => mysqli_fetch_assoc($qry));
  print json_encode($data);
}

function viewDocByDisease($disease) {
  $qry = mysqli_query(Config::dbConnect(), "SELECT doctors.id, doctors.name as doctorName, doctors.otherDetails, diseases.name as disease, hospitals.name as hospital FROM doctors INNER JOIN hospitals ON hospitals.id = doctors.hospital INNER JOIN diseases ON doctors.specialization = diseases.id WHERE diseases.name = '$disease';");
  $data = array();
  while($row = mysqli_fetch_assoc($qry)) {
    $data[] = $row;
  }
  $data = array("disease" => $data);
  print json_encode($data);
}


function viewHospitals() {
  $qry = mysqli_query(Config::dbConnect(), "SELECT hospitals.id, hospitals.name, hospitals.location, counties.name FROM hospitals LEFT JOIN counties ON counties.id = hospitals.county ORDER BY counties.name ASC;");
  $data = array();
  while($row = mysqli_fetch_assoc($qry)) {
    $data[] = $row;
  }
  $data = array("hospitals" => $data);
  print json_encode($data);
}

function viewHospital() {
  $hospitalId = $_POST['hospitalId'];

  $qry = mysqli_query(Config::dbConnect(), "SELECT hospitals.id, hospitals.name, hospitals.location, counties.name FROM hospitals LEFT JOIN counties ON counties.id = hospitals.county WHERE hospitals.id = '$hospitalId';");
  $data = array("hospital" => mysqli_fetch_assoc($qry));
  print json_encode($data);
}

function viewPharmacies() {
  $qry = mysqli_query(Config::dbConnect(), "SELECT pharmacies.id, pharmacies.name, pharmacies.phoneNumber, pharmacies.location, counties.name as county FROM pharmacies INNER JOIN counties ON counties.id = pharmacies.county ORDER BY counties.name ASC;");
  $data = array();
  while($row = mysqli_fetch_assoc($qry)) {
    $data[] = $row;
  }
  $data = array("pharmacies" => $data);
  print json_encode($data);
}

function viewPharmacy() {
  $pharm = $_POST['pharmacy'];
    $qry = mysqli_query(Config::dbConnect(), "SELECT pharmacies.id, pharmacies.name, pharmacies.phoneNumber, pharmacies.location, counties.name FROM pharmacies INNER JOIN counties ON counties.id = pharmacies.county WHERE pharmacies.id = '$pharm';");
    $data = array("pharmacy" => mysqli_fetch_assoc($qry));
    print json_encode($data);
}

function pharmMedics($name) {
  $qry = mysqli_query(Config::dbConnect(), "SELECT  medicine.name AS medicine FROM pharmacies INNER JOIN pharmacyMedicine ON pharmacyMedicine.pharmacy = pharmacies.id INNER JOIN medicine ON pharmacyMedicine.medicine = medicine.id WHERE pharmacies.name = '$name' ORDER BY medicine.name ASC;");

  $data = array();
  while($row = mysqli_fetch_assoc($qry)) {
    $data[] = $row;
  }
  $data = array("pharmMedics" => $data);
  print json_encode($data);
}

function viewDisease() {
  $disease = $_SESSION['specialization'];
  $qry = mysqli_query(Config::dbConnect(), "SELECT diseases.name FROM diseases WHERE id = '$disease';");
  print json_encode(mysqli_fetch_assoc($qry)['name']);
}

function addPrescription() {
  $doctor = $_SESSION['docid'];
  $patient = $_POST['patient'];
  $prescription = $_POST['prescription'];
  $dosage = $_POST['dosage'];

  $qry = mysqli_query(Config::dbConnect(), "INSERT INTO patientPrescription (id, patient, doctor, prescription, dosage) VALUES ('', '$patient', '$doctor', '$prescription', '$dosage')");
  if($qry) print json_encode(1);
  else print json_encode(0);
}

?>

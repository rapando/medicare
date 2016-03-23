<?php
if(isset($_POST['req'])) {
  include "config.php";

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
  }
} else print "no request";

function docLogin() {
  $username = strtolower(trim($_POST['uname']));
  $pass     = $_POST['pass'];
  $qryUname = mysqli_query(Config::dbConnect(), "SELECT id, username FROM doctors WHERE username = '$username';");
  $no       = mysqli_num_rows($qryUname);
  if ($no > 0) {
    $qryPass    = mysqli_query(Config::dbConnect(), "SELECT id, pass, salt FROM doctors WHERE username = '$username';");
    $stored     = mysqli_fetch_array($qryPass);
    $storedPass = $stored['pass'];
    $storedSalt = $stored['salt'];
    if (Config::passHasher($pass, $storedSalt) == $storedPass) {
      session_start();
      $_SESSION['docid'] = $stored['id'];
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
    $stored     = mysqli_fetch_array($qryPass);
    $storedPass = $stored['pass'];
    $storedSalt = $stored['salt'];
    if (Config::passHasher($pass, $storedSalt) == $storedPass) {

      print "1";
    } else {
      print "0";
    }
  } else print "Wrong credentials";
}

?>

<?php
if(isset($_POST['req'])) {
  include "config.php";

  switch($_POST['req']) {
    // ad a doctor

    case 'docLogin':
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
    break;

    case 'addDoc':
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
        } else {
          print "Oops, There was a proble creating your accout. Contact the Admin for more details";
        }
      }
    break;

    case 'addPatient':
      
    break;
  }
}
?>

<?php
if ($_POST['req']) {
	include "../src/php/config.php";

	switch ($_POST['req']) {
		case 'login':
			$username = strtolower(trim($_POST['username']));
			$pass     = $_POST['pass'];
			$qryUname = mysqli_query(Config::dbConnect(), "SELECT id, username FROM admin WHERE username = '$username';");
			$no       = mysqli_num_rows($qryUname);
			if ($no > 0) {
				$qryPass    = mysqli_query(Config::dbConnect(), "SELECT id, pass, salt FROM admin WHERE username = '$username';");
				$stored     = mysqli_fetch_array($qryPass);
				$storedPass = $stored['pass'];
				$storedSalt = $stored['salt'];
				if (Config::passHasher($pass, $storedSalt) == $storedPass) {
					session_start();
					$_SESSION['adminId'] = $stored['id'];
					header("location:./");
				} else {
					print"Wrong username or password";
					header("refresh:1;url=login.php");
				}
			} else {
				print"Wrong username or password";
				header("refresh:1;url=login.php");
			}
			break;
	}

} else {
	print"no request";
}

?>
<?php
session_start();
if (empty($_SESSION['docid'])) {header("location:../");
} else {
	include "../src/php/config.php";

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta name="authors" content="samson rapando, abednego wambua, samsonrapando@gmail.com , abedxh@gmail.com" />
	<meta name="description" content="A medical care system" />
	<meta name="keywords" content="Medicare, Unify,  Hackathon" />
	<link rel="stylesheet" type="text/css" href="../bower_components/Materialize/dist/css/materialize.min.css" />
	<link rel="stylesheet" type="text/css" href="../src/css/medicare.css" />

	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<script src="../bower_components/Materialize/dist/js/materialize.min.js"></script>

</head>
<body>

<nav class="white z-depth-1">
	<div class="wrapper ">
		<a href="#" title="medicare" class="brand-logo right">Medicare | Doc</a>
	</div>
</nav>

<div class="main-body row left-align">
	<div class="col s12 m3 l3 grey lighten-3">
		<div class="section">
			<a href="#my-patients"><h4>My Patients</h4></a>
			<a href="#my-appointments"><h4>My Appointments</h4></a>
			<a href="#my-prescriptions"><h4>My Prescription</h4></a>
		</div>
	</div>


	<div class="col s12 m9 l9">
		<div class="container" id="my-patients">
			<ul id="my-patients-table">
				<li style="opacity:0"><h3>My Patients</li>
					<li style="opacity:0"></li>
			</ul>
		</div>



		<div class="container" id="my-appointments">
			<ul id="my-appointments-table">
				<li style="opacity:0"><h3>My Appointments</h3></li>
				<li style="opacity:0"></li>
			</ul>
		</div>

		<div class="container" id="my-prescriptions">
			<ul id="my-prescriptions-table">
				<li style="opacity:0"><h3>My Prescriptions</h3></li>
				<li style="opacity:0"></li>
			</ul>
		</div>
	</div>
</div>
<script src="../src/js/doc.js"></script>
</body>
</html>

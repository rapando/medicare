<?php
session_start();
if (empty($_SESSION['docid'])) {header("location:../");
} else {
	include "../src/php/config.php";
	//fetch the patients
	$qry = mysqli_query(Config::dbConnect(), "SELECT * FROM patients ORDER BY username ASC;");
	$patients = "<table class='bordered striped responsive'><thead><tr><th>Uname</th><th>email</th></tr></thead><tbody>";

	while($row = mysqli_fetch_array($qry)) {
		$uname = $row['username'];
		$email = $row['email'];
		$id = $row['id'];

		$patients = $patients . "<tr onclick='prescribe($id)'><td>$uname</td><td>$email</td></tr>";
	}
	$patients = $patients . "</tbody></table>";

	//fetch my appointments

	$qry = mysqli_query(Config::dbConnect(), "SELECT appointments.id, patients.username as patient, appointments.moment, appointments.status FROM appointments INNER JOIN patients ON patients.id = appointments.patient INNER JOIN doctors ON doctors.id = appointments.doctor ORDER BY appointments.id DESC;");
	$pending = "<h3>Pending</h3><table class='bordered striped responsive'><thead><tr><th>Name</th><th>Date</th><th>Approve</th></tr></thead>";
	$approved = "<h3>Approved</h3><table class='bordered striped responsive'><thead><tr><th>Name</th><th>Date</th></tr></thead><tbody>";
	while($row = mysqli_fetch_assoc($qry)) {
		$name = $row['patient'];
		$id = $row['id'];
		$moment = $row['moment'];
		$status = $row['status'];

		if($status == 'pending') $pending = $pending. "<tr><td>$name</td><td>$moment</td><td><a href='approve.php?id=$id'>Approve</a></td></tr>";
		else $approved = $approved .  "<tr><td>$name</td><td>$moment</td></tr>";
	}

	$pending = $pending."</tbody></table>";
	$approved = $approved."</tbody></table>";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Doc</title>
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
		<ul>
			<li><a href="#my-patients" style="color : black !important ">My Patients</a></li>
			<li><a href="#my-appointments" style="color : black !important ">My Appointments</a></li>
			<!-- <li><a href="#my-prescriptions" style="color : black !important ">My Prescription</a></li> -->
		</ul>
	</div>
</nav>

<div class="main-body row left-align">

	<div class="col s12 m10 l10 offset-m1 offset-l1">
		<div class="container" id="my-patients">
			<ul id="my-patients-table">
				<li style="opacity:0"><h3>Patients</li>
					<li style="opacity:0">
						<?php print $patients; ?>
					</li>
			</ul>
		</div>



		<div class="container" id="my-appointments">
			<ul id="my-appointments-table">
				<li style="opacity:0"><h3>My Appointments</h3></li>
				<li style="opacity:0"><?php print $pending; ?></li>
					<li style="opacity:0"><?php print $approved; ?></li>
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


<a href="../src/php/logout.php" class="btn btn-large btn-floating red right floating-logout-btn" title="logout"><i class="material-icons">settings_power</i></a>


<a href="#top" class="btn btn-large btn-floating red right floating-top-btn"><i class="material-icons">present_to_all</i></a>
<script src="../src/js/admin.js"></script>

<script src="../src/js/doc.js"></script>
</body>
</html>


<div class="modal modal-prescribe">
	<div class="modal-content">
      <h4>Prescribe Medication for <span class="disease-name"></span></h4>
			<div class="input-field col s12 m10 l10 offset-m1 offset-l1">
				<input type="text" id="prescription" placeholder="prescription" />
			</div>
			<div class="input-field col s12 m10 l10 offset-m1 offset-l1">
				<input type="text" id="dosage" placeholder="dosage" />
			</div>

			<button class="btn tealright" id="add-dosage">Add</button>

    </div>
    <div class="modal-footer">
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat ">Done</a>
    </div>
		<button id="submit-dosage"
</div>

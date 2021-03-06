<?php
session_start();
if (empty($_SESSION['adminId'])) {header("location:login.php");
} else {
	include "../src/php/config.php";

	// fetch the counties
	$qry      = mysqli_query(Config::dbConnect(), "SELECT * FROM counties ORDER BY name ASC;");
	$counties = '<option value="" disabled selected >-county-</option>';
	while ($county = mysqli_fetch_array($qry)) {
		$id       = $county['id'];
		$name     = $county['name'];
		$counties = $counties."<option value='$id'>$name</option>";
	}

// fetch the doctors
	$qry = mysqli_query(Config::dbConnect(), "SELECT * FROM doctors ORDER BY name ASC;");
	$data = "<table class='bordered striped responsive'><thead><tr><th>Uname</th><th>Name</th><th>Other Details</th></tr></thead><tbody>";

	while($row = mysqli_fetch_array($qry)) {
		$uname = $row['username'];
		$name = $row['name'];
		$otherDetails = $row['otherDetails'];
		$data = $data . "<tr><td>$uname</td><td>$name</td><td>$otherDetails</td></tr>";
	}
	$data = $data . "</tbody></table>";

//fetch the patients
$qry = mysqli_query(Config::dbConnect(), "SELECT * FROM patients ORDER BY username ASC;");
$patients = "<table class='bordered striped responsive'><thead><tr><th>Uname</th><th>email</th></tr></thead><tbody>";

while($row = mysqli_fetch_array($qry)) {
	$uname = $row['username'];
	$email = $row['email'];

	$patients = $patients . "<tr><td>$uname</td><td>$email</td></tr>";
}
$patients = $patients . "</tbody></table>";
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
	<div class="nav-wrapper ">
		<a href="#" title="medicare" class="brand-logo right">Medicare | Admin</a>
		<ul >
			<li><a href="#add-hospital" style="color:black !important">+ Hospital</a></li>
			<li><a href="#add-pharmacy" style="color:black !important">+ Pharmacy</a></li>
			<li><a href="#viewDocs" style="color:black !important">View Doctors</a></li>
			<li><a href="#viewPats" style="color:black !important">View Patients</a></li>

    </ul>
	</div>
</nav>



<div class="main-body row" >

	<div class="col s12 m10 l10 offset-m1 offset-l1">
		<div class="container" id="add-hospital">
		<form >
			<ul id="add-hospital-form">
				<li style="opacity: 0"><h3>Add Hospital</h3></li>
				<div class="row">
					<li style="opacity:0">
						<div class="input-field col m10 l10 offset-m1 offset-l1">
							<input type="text" name="hospitalName" id="hospitalName" placeholder="Hospital Name" required  autofocus/>
						</div>
					</li>

					<li style="opacity:0">
						<div class="input-field col m10 l10 offset-m1 offset-l1">
							<input type="text" name="hospitalLocation" id="hospitalLocation" placeholder="Location"  required />
						</div>
					</li>

					<li style="opacity: 0">
						<div class="input-field col m10 l10 offset-m1 offset-l1">
							<select name="county" id="county" required>
								<?php
								print $counties;
								?>
							</select>
						</div>
					</li>

					<li style="opacity:0">
					<button type="submit" id="addHospitalBtn" class="btn waves-effect waves-light right offset-m1 offset-l1">Add</button>
					</li>
					<br />.
					<div class="progress progress1">
						<div class="indeterminate"></div>
					</div>
				</div>
			</ul>
		</form>
		</div>


		<div class="divider"></div>


		<div class="container" id="add-pharmacy">
			<form>
			<ul id="add-pharmacy-form">
				<li style="opacity: 0"><h3>Add Pharmacy</h3></li>
				<div class="row">
					<li style="opacity:0">
						<div class="input-field col m10 l10 offset-m1 offset-l1">
							<input type="text" name="pharmacyName" id="pharmacyName" placeholder="Pharmacy Name" required  autofocus/>
						</div>
					</li>

					<li style="opacity:0">
						<div class="input-field col m10 l10 offset-m1 offset-l1">
							<input type="text" name="pharmacyLocation" id="pharmacyLocation" placeholder="Location"  required />
						</div>
					</li>

					<li style="opacity: 0">
						<div class=" col m5 l5 offset-m1 offset-l1">
							<select name="pharmacyCounty" id="pharmacyCounty" required>
								<?php
								print $counties;
								?>
							</select>
						</div>
					</li>

					<li style="opacity : 0">
						<div class="input field col s12 m5 l5 offset-m1 offset-l1">
							<input type="text" name="pharmacyPhone" id="pharmacyPhone" placeholder="Phone Number" required maxlength="10"/>
						</div>
					</li>

					<li style="opacity:0">
					<button type="submit" id="addPharmacyBtn" class="btn waves-effect waves-light right offset-m1 offset-l1">Add</button>
					</li>
					<br />.
					<div class="progress progress2">
						<div class="indeterminate"></div>
					</div>
				</div>
			</ul>
		</form>
		</div>

		<div class="divider"></div>

		<div class="container" id="viewDocs">
			<div class="progress progress3">
				<div class="indeterminate"></div>
			</div>
			<ul id="doc-list">
				<li style="opacity:0"><h3>Doctors</h3></li>
				<li style="opacity :0">
					<?php print $data; ?>
				</li>
			</ul>
		</div>

		<div class="divider"></div>
		<div class="container" id="viewPats">
			<div class="progress progress3">
				<div class="indeterminate"></div>
			</div>
			<ul id="pat-list">
				<li style="opacity:0"><h3>Patients</h3></li>
				<li style="opacity :0">
					<?php print $patients; ?>
				</li>
			</ul>
		</div>


	</div>
</div>

<a href="../src/php/logout.php" class="btn btn-large btn-floating red right floating-logout-btn" title="logout"><i class="material-icons">settings_power</i></a>


<a href="#top" class="btn btn-large btn-floating red right floating-top-btn"><i class="material-icons">present_to_all</i></a>
<script src="../src/js/admin.js"></script>
</body>
</html>

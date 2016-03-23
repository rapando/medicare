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
		<a href="#" title="medicare" class="brand-logo right">Medicare | Admin</a>
	</div>
</nav>

<div class="main-body row">
	<div class="col m3 l3 grey lighten-3">
		<div class="section">
			<a href="#add-hospital"><h4>Add Hospital</h4></a>
		</div>
	</div>


	<div class="col m9 l9">
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
print$counties;
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
	</div>
</div>
<script src="../src/js/admin.js"></script>
</body>
</html>

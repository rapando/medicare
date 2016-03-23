<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta name="authors" content="samson rapando, abednego wambua, samsonrapando@gmail.com , abedxh@gmail.com" />
	<meta name="description" content="A medical care system" />
	<meta name="keywords" content="Medicare, Unify,  Hackathon" />
	<link rel="stylesheet" type="text/css" href="../bower_components/Materialize/dist/css/materialize.min.css" />
	<link rel="stylesheet" type="text/css" href="../src/css/medicare.css" />

	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<script src="../bower_components/Materialize/dist/js/materialize.min.js"></script>

	<style>
		body {background: url('../files/medical-care.jpg') ; background-size: cover}
		form {margin-top: 25% !important; padding-top: 3%; padding-bottom: 3%;}
		button {margin-left: 30%;}
	</style>

</head>
<body>

<div class="container dark lighten-2">
	<form name="loginForm" action="admin.php" method="POST" class="card teal  row">
	<div class="col s12 m6 l6 offset-m3 offset-l3">
		<input type="text" name="username" placeholder="username" required autofocus />

	</div>
	<div class="col s12 m6 l6 offset-m3 offset-l3">
		<input type="password" name="pass" placeholder="password" required>
	</div>

	<button type="submit" name="req" value="login" class="btn waves-effect  white black-text left waves-light">Login</button>
	</form>
</div>


</body>
</html>
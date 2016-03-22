<!DOCTYPE html>
<html>
<head>
	<title>medicare</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta name="authors" content="samson rapando, abednego wambua, samsonrapando@gmail.com , abedxh@gmail.com" />
	<meta name="description" content="A medical care system" />
	<meta name="keywords" content="Medicare, Unify,  Hackathon" />
	<link rel="stylesheet" type="text/css" href="bower_components/Materialize/dist/css/materialize.min.css" />
	<link rel="stylesheet" type="text/css" href="src/css/medicare.css" />

	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/Materialize/dist/js/materialize.min.js"></script>

</head>
<body>

<nav class="white z-depth-1">
	<div class="wrapper ">
		<a href="#" title="medicare" class="brand-logo right">Medicare</a>
	</div>
</nav>
<div class="main-body">
<div class="slider">
<ul class="slides">
	<li>
		<img src="files/medical-care.jpg" />
		<div class="caption left-align">
		<h3 >This is the tagline</h3>
		<h5 class="light grey-text text-lighten-3">Here's the logo</h5>
		</div>
	</li>
	<li>
		<img src="files/Medical-Symbol-Care-for-Children-and-Adults.jpg" alt="" />
		<div class="caption left-align">
		<h3 class="dark-text" >This is the tagline</h3>
		<h5 class="light grey-text text-lighten-3">Here's the logo</h5>
		</div>
	</li>
	<li>
		<img src="files/shutterstock_102414841.jpg" alt="" />
		<div class="caption left-align">
		<h3 ca>This is the tagline</h3>
		<h5 class="light grey-text text-lighten-3">Here's the logo</h5>
		</div>
	</li>
</ul>
</div>

<div class="divider"></div>


<div class="row container">
<form>
<ul id="loginForm">
	<li style="opacity:0"><h3 class="center-align dark-text">Login</h3></li>
	<div class="row">
	<li style="opacity: 0" >
		<div class="input-field col s12 m5 l5 offset-m1 offset-l1">
			<input type="text" name="uname" id="uname" placeholder="username"  required autofocus />
		</div>
	</li>
	<li style="opacity:0">
		<div class="input-field col s12 m5 l5 offset-m1 offset-l1">
			<input type="password" name="pass" id="pass" value="" placeholder="Password" />
		</div>
	</li>
	</div>
	<li class="row" style="opacity: 0">
			<button type="submit" class=" col right offset-m1 offset-l1 btn  teal waves-effect waves-light loginBtn ">Login</button>
	</li>

	<div class="progress progress1">
		<div class="indeterminate"></div>
	</div>

	<li style="opacity:0" class="center-align forgot teal-text"><a href="#forgot">I forgot my Password</a></li>

</ul>
</form>

<br /><div class="divider"></div><br />
<div id="forgot">

	<ul id="resetForm">
	<li style="opacity:0"><h3 class="center-align dark-text">Reset Password</h3></li>
		<div class="row">
			<li style="opacity: 0">
				<div class="input-field col s12 m10 l10 offset-m1 offset-l1">
					<input type="email" name="email"  id="email" placeholder="email address" />
				</div>
			</li>

		</div>
		<li class="row" style="opacity : 0">
			<button type="submit" class="btn col offset-m1 offset-l1 right teal waves-effect waves-light resBtn">Reset</button>
		</li>

		<div class="progress progress2">
		<div class="indeterminate"></div>
	</div>
	</ul>
</div>

</div>

<br /><div class="divider"></div><br />
</div>
<script src="src/js/main.js"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Success! | Cinema Hunt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<a href="/"><img src="../images/logo.jpg" class="logo-details"></a>
	</div>
	<div class="dashboard col-xs-8 col-xs-offset-2">
		<h2>Success!</h2>
		<h2>Welcome to the safari, <span class="highlight">  {{$user}}.</span></h2>
		<h3>Please now <a href="login">Log In</a> with your username and password.</h3>
	</div>
</body>
</html>
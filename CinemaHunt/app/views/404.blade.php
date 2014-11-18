<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>404 | Cinema Hunt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<a href="/"><img src="images/logo.jpg" class="logo-details"/></a>
		@if(Session::get('user'))
		<h3 class="col-sm-8"><a href="dashboard">Dashboard </a>| <a href="signup">Sign Up</a></h3>
		@else
		<h3 class="col-sm-8"><a href="login">Login</a> | <a href="signup">Sign Up</a></h3>
		@endif
	</div>
	<!-- <h2 class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0"></h2> -->
	<div class="results col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-0">
		<h2>Sorry, there was an error.</h2>
		<h3>Not sure what happened.</h3>
	</div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Sign Up | Cinema Hunt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
			<a href="/"><img src="../images/logo.jpg" class="logo-details"></a>
			<a href="login">Already a user? Login here.</a>
	</div>
	<div class="col-xs-8 col-xs-offset-2">
		<h2>Sign Up</h2>
		<form method="POST" action="signup">
		<div class="col-xs-12">
			<input class="col-sm-6 col-xs-12" type="text" name="username" placeholder="Username" autofocus required/>
		</div>
		<div class="col-xs-12">
			<input class="col-sm-6 col-xs-12" type="password" name="password" placeholder="Password" required/>
		</div>
		<div class="col-xs-12">
			<input class="col-sm-6 col-xs-12 btn" type="submit" value="Log In" />
		</div>
		</form>
	</div>
	
</body>
</html>
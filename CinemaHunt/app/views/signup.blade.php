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
	<div>
		<a href="/"><img src="../images/logo.jpg" height="203" width="480"/></a>
	</div>
	<h2>Sign Up</h2>
	<form method="POST" action="signup">
		<input type="text" name="username" autofocus placeholder="Username"/>
		<input type="text" name="password" placeholder="Password"/>
		<input type="submit" value="Sign Up"/>
	</form>
	
</body>
</html>
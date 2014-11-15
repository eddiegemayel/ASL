<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Log In | Cinema Hunt</title>
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
	<h2>Log In</h2>
	<form method="POST" action="login">
		<input type="text" name="username" placeholder="username" autofocus/>
		<input type="password" name="password" placeholder="password" />
		<input type="submit" value="Log In" class="btn" />
	</form>
	
</body>
</html>
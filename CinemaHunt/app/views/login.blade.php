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
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<a href="/"><img src="../images/logo.jpg" class="logo-details"></a>
	</div>
	<div class="col-xs-8 col-xs-offset-2">
		<h2>Log In</h2>
		<form method="POST" action="login">
		<div class="col-xs-12">
			<input type="text" name="username" placeholder="username" autofocus required/>
		</div>
		<div class="col-xs-12">
			<input type="password" name="password" placeholder="password" required/>
		</div>
		<div class="col-xs-12">
			<input type="submit" value="Log In" class="btn" />
		</div>
		</form>
	</div>
</body>
</html>
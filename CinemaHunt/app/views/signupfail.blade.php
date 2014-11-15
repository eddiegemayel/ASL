<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Sorry! | Cinema Hunt</title>
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
	<h2>Sorry!</h2>
	<div class="dashboard">
		<h2>It <span class="highlight"> Failed! {{$user}} already exists.</span></h2>
	</div>
</body>
</html>
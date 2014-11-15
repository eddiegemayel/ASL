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
	<div>
		<a href="/"><img src="images/logo.jpg" height="203" width="480"/></a>
	</div>
	<h2>Success!</h2>
	<div class="dashboard">
		<h2>welcome, <span class="highlight">  {{$user}}. Youve been added to the database</span></h2>
	</div>
</body>
</html>
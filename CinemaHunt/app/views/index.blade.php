<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Cinema Hunt</title>
	<!--<script src="{{URL::asset('js/bootstrap.js')}}"></script>-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class='row'>
	<a href="/"><img class="logo col-xs-8" src="images/logo.jpg"></a>
	</div>
	<div class="form row">
	<form class="searchForm col-xs-12" method="POST" action="results">
		<input class="search col-sm-7" type="text" name="title" pattern=".{2,}" title="2 characters minimum" autofocus required placeholder="Title of the movie you want to hunt . . ."/>
		<input class="btn col-sm-4" type="submit" value="LET'S FIND 'EM!"/>
	</form>
	</div>
	<div class="actions row">
		<p><a href="signup">Sign Up</a></p>
		<p><a href="login">Log In</a></p>
	</div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Dashboard | Cinema Hunt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<a href="/"><img src="../images/logo.jpg" class="logo-details"></a>
		<a href="logout">Logout</a>
	</div>
	<div class="dashboard col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<div class="movieDetails col-sm-6 col-xs-12">
			<h2>Dashboard</h2>
			<h3>Welcome, {{$user->username}}</h3>
			<p>Your password is : {{$user->password}}</p>
			<p>For Developer Purposes, your unique userid is : <span class="highlight">{{$user->id}}</span></p>
		</div>

		<div class="people col-sm-6 col-xs-12">
			<h2>Your Favorite Movies</h2>
			@for($i = 0; $i < count($query, COUNT_RECURSIVE) ; $i ++)

			<p>{{$query[$i]->movieid}}</p>
			
	
			@endfor


		</div>
	</div>
</body>
</html>
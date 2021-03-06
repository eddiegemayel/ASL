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
		<h1>Dashboard</h1>
		<div class="col-sm-6 col-xs-12">
			<h3>Welcome, {{$user->username}}</h3>
			<p>Your password is : <span class="highlight">{{$user->password}}</span></p>
			<p>Your unique User Id is : <span class="highlight">{{$user->id}}</span></p>
		</div>

		<div class="col-sm-6 col-xs-12">
			<h3>Your Favorite Movies</h3>
			@if($count>0)

				@for($i = 0; $i < count($query, COUNT_RECURSIVE) ; $i ++)

				<p>
					<a href="remove/{{$query[$i]->id}}"><span class="delete">X</span></a>
					<a href="/details/{{$query[$i]->movieid}} ">{{$query[$i]->movietitle}}</a> <span class="highlight">({{$query[$i]->movieyear}})
					</span> 
					
				</p>
				@endfor
				<p><span class="bold">+</span> Go on the <a href="/">Hunt</a> for more movies!</p>
			@else
			<h1><a href="/">Start Hunting Movies!</a></h1>
			@endif
		</div>
		
	</div>
	<div class="col-sm-6 col-sm-offset-2">
		<h3>You May Also Like </h3>
		@if($count > 0)
		<p><a href="/details/{{$rec1->imdbID}}">{{$rec1->Title}}</a> <span class="highlight">({{$rec1->Year}})</span></p>
		<p><a href="/details/{{$rec2->imdbID}}">{{$rec2->Title}}</a> <span class="highlight">({{$rec2->Year}})</span></p>
		@else
		<p>You have no favorites!</p>
		@endif
	</div>
</body>
</html>
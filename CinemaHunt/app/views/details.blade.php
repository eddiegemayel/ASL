<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Details | {{$info->Title}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="favicon.ico"/>
	<link rel="stylesheet" href="{{URL::asset('css/main.css')}}" type="text/css"/>
</head>
<body>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<a href="/"><img src="../images/logo.jpg" class="logo-details"></a>
		@if(Session::get('user'))
		<h3 class="col-sm-8"><a href="/dashboard">Dashboard </a>| <a href="/signup">Sign Up</a></h3>
		@else
		<h3 class="col-sm-8"><a href="/login">Login</a> | <a href="/signup">Sign Up</a></h3>
		@endif
	</div>

	<div class="details col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		
		<div class="movieDetails col-sm-6 col-xs-12">
			<h1>{{$info->Title}}</h1>
			<p>{{$info->Rated}} - {{$info->Runtime}}</p>
			<p>{{$info->Released}}</p>
			<p>{{$info->Genre}}</p>
			<p>({{$info->Country}}), {{$info->Language}}</p>
			</br>
			<p><span class="bold">Directed By :</span> {{$info->Director}}</p>
			<br/>
			<p><span class="bold">Written By :</span> {{$info->Writer}}</p>
			<br/>
			<p><span class="bold">Starring :</span> {{$info->Actors}}</p>
			</br>
			<p><span class="bold">Summary :</span> {{$info->Plot}}</p>
		</div>

		<div class="people col-sm-6 col-xs-12">
			<h3>The People Have Spoken!</h3>
			<p><span class="bold">Awards :</span> {{$info->Awards}}</p>
			<p><span class="bold">IMDb Rating :</span> <span class="highlight">{{$info->imdbRating}}</span> ({{$info->imdbVotes}} votes)</p>
			<p><span class="bold">Metascore : </span><span class="highlight">{{$info->Metascore}}</span></p>
			<p>For more details visit <a href="http://www.imdb.com/title/{{$info->imdbID}}/" target="_blank">IMDb.</a></p>
			<button class="btn">ADD TO FAVORITES</button>
		</div>
	</div>
</body>
</html>
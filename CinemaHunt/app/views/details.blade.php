<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Details | Cinema Hunt</title>
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

	<div class="details">
		<div class="people">
			<h3>The People Have Spoken!</h3>
			<p><span class="bold">Awards :</span> {{$info->Awards}}</p>
			<p><span class="bold">imdb Rating :</span> <span class="highlight">{{$info->imdbRating}}</span> ({{$info->imdbVotes}} votes)</p>
			<p><span class="bold">Metascore : </span><span class="highlight">{{$info->Metascore}}</span></p>
			<p>For more details visit <a href="http://www.imdb.com/title/{{$info->imdbID}}/">imdb.</a></p>
			<button class="btn">ADD TO FAVORITES</button>
		</div>
		<div class="movieDetails">
			<h1>{{$info->Title}}</h1>
			<p>{{$info->Rated}} - {{$info->Runtime}}</p>
			<p>{{$info->Released}}</p>
			<p>{{$info->Genre}}</p>
			<p>({{$info->Country}}), {{$info->Language}}</p>
			</br>
			<p><span class="bold">Directed By :</span> {{$info->Director}}</p>
			<p><span class="bold">Written By :</span> {{$info->Writer}}</p>
			<p><span class="bold">Starring :</span> {{$info->Actors}}</p>
			</br>
			<p><span class="bold">Summary :</span> {{$info->Plot}}</p>
		</div>
	</div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Results | Cinema Hunt</title>
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
	<h2>Results for "{{$query}}" : </h2>
	<div class="results">
	@for($i = 0; $i < count($new, COUNT_RECURSIVE) ; $i ++)

		<p><a href="details/{{$search->Search[$i]->imdbID}}">{{$search->Search[$i]->Title}}</a> - {{$search->Search[$i]->Year}} - 
		<span class="highlight">{{ucfirst($search->Search[$i]->Type)}}</span></p>
	
	@endfor
	</div>
</body>
</html>
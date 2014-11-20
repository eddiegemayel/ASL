<?php

// http://www.omdbapi.com/?s=300&r=json
//http://www.omdbapi.com/?i=tt0416449&r=json
//HomeController@showresults

//------------------------------------------------------------------------------------------------GETS
//home route just returns index page
Route::get('/', function()
{	
	return View::make('index');
});

//when user clicks a signup link
Route::get('signup', function(){
	//bring them to sign up page
	return View::make('signup');
});

//renders login page when user clicks on it
Route::get('login', function(){
	return View::make('login');
});

//calls detail page with corresponding imdb id in the GET
Route::get('details/{imdbID}', 'HomeController@details');

//log out route
Route::get('logout', 'HomeController@logout');

Route::get('remove/{id}', 'HomeController@remove');

//dashboard route 
Route::get('dashboard', 'HomeController@dashboard');

//error if they just type results in the url
Route::get('/results', function(){
	return View::make('404');
});

//------------------------------------------------------------------------------------------------------POSTS

//inserts new user into database
Route::post('signup', 'HomeController@register');

//when user submits login form
Route::post('login', 'HomeController@login');
	
//calls results function in the home controller
Route::post('results', 'HomeController@results');

//add favorites post
Route::post('/fav/{imdbID}', 'HomeController@addFavorite');
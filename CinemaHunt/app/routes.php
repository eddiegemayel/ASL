<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// http://www.omdbapi.com/?s=300&r=json
//http://www.omdbapi.com/?i=tt0416449&r=json
//HomeController@showresults

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

//inserts new user into database
Route::post('signup', 'HomeController@register');

//renders login page when user clicks on it
Route::get('login', function(){
	return View::make('login');
});

//when user submits login form
Route::post('login', 'HomeController@login');
	

//calls results function in the home controller
Route::post('results', 'HomeController@results');

//calls detail page with corresponding imdb id in the GET
Route::get('details/{imdbID}', 'HomeController@details');

Route::get('logout', 'HomeController@logout');









//TEST THINGS-------------------------------

//mysql database json return


// Route::get('test', function(){
// 	//new empty data array
// 	$data = array();

// 	//query data base
// 	$results = DB::table('users')->get();

// 	$username = DB::table('users')->where('username', 'hello')->pluck('password');

// 	//var dumps username
// 	// var_dump($results[0]->username);

// // 	foreach ($results as $user)
// // {
// //     var_dump($user->username);
// // }

// 	$data['users'] = $results;
// 	$data['username'] = $username;

// 	return View::make('test', $data);
// });




//auth????

// $creds = Input::only('username', 'password');

	// if(Auth::attempt($creds)){
	// 	return Redirect::intended('/');
	// }
	// return Redirect::to('login');
	// $username = Input::get('username');
	// $password = Input::get('password');

	// if(Auth::attempt(array('username' => $username, 'password' => $password))){
	// 	return Redirect::intended('test');
	// }	
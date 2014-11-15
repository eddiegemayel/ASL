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
// // http://www.omdbapi.com/?s=300&r=json
//HomeController@showresults

Route::get('/', function()
{	
	return View::make('index');
});

Route::get('signup', function(){
	return View::make('signup');
});

Route::post('signup', function(){

	//inserts new user into database

	$username = Input::get('username');
	$password = Input::get('password');

	$id = DB::table('users')->insertGetId(
    array('username' => $username, 'password' => $password)
	);

	$data = array();

	$data['username'] = $username;

	return View::make('test', $data);

});

Route::get('login', function(){
	//just return login page when user clicks on it
	return View::make('login');
});

Route::post('login', function(){

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

	//grab username and password entered when form is triggered by post
	$username = Input::get('username');
	$password = Input::get('password');


	$results = DB::table('users')
            ->where('username', $username)
            ->where('password' , $password)
            ->get();

    if($results != []){
    	var_dump($results);
    }else{
    	var_dump($username);
    }

     
});

//calls results function in the home controller
Route::post('results', 'HomeController@results');

//calls detail page with corresponding imdb id in the GET
Route::get('details/{imdbID}', 'HomeController@details');











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
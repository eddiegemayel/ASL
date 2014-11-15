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
Route::post('signup', function(){
	//empty data array for passing to view
	$data = array();
	
	//grab user inputs
	$username = Input::get('username');
	$password = Input::get('password');

	//query database with what user entered
	$results = DB::table('users')
            ->where('username', $username)
            ->get();

      //count how many matches came back form the database
     $count = count($results, COUNT_RECURSIVE);
     // var_dump($count);

    //if no user matched results entered for signup
    if($count === 0){

    	//run insert command
    	$id = DB::table('users')->insertGetId(
    		array('username' => $username, 'password' => $password)
		);

    	//grab username to welcome them
    	$data['user'] = $username;

    	//point them to dashboard
    	return View::make('signupsuccess', $data);
    	// var_dump($results[0]->username);

    //if users matched that username
    }else if($count > 0){
    	//grab username to tell them its taken
    	$data['user'] = $username;

    	//render view and pass the data
    	return View::make('signupfail', $data);
    }

});

//renders login page when user clicks on it
Route::get('login', function(){
	return View::make('login');
});

//when user submits login form
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

	//new empty data array
	$data = array();

	//grab username and password entered when form is triggered by post
	$username = Input::get('username');
	$password = Input::get('password');

	//database query
	//SELECT * FROM users WHERE username = username & password = password
	$results = DB::table('users')
            ->where('username', $username)
            ->where('password' , $password)
            ->get();

    //if the results are not empty
    if($results != []){
    	//store resuts into data array
    	$data['user'] = $results;

    	//point them to dashboard
    	return View::make('dashboard', $data);
    	// var_dump($results[0]->username);
    }else{
    	$data['user'] = $username;

    	//otherwise tell them they messed up
    	return View::make('test', $data);
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
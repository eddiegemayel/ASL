<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|	// var dump for testing
	|	//Type of movie var dumps
	|	// var_dump($results->Search[0]->Type);
	|	//counts number of objects in array
	|	// var_dump(count($new_res, COUNT_RECURSIVE));
	|
	*/
 	
 	//this function gets the results from our Open Movie Database API
	public function results (){
		//get the title the user entered in the input
		$title = Input::get('title');

		//replace empty spaces in that string with %20 so the API URL doesn't get mad
		$fixed_title = str_replace(" ", "%20", $title);

		//create an empty array to store results
		$data = array();

		//API url concatenated with the user entered search term 
		$url = "http://www.omdbapi.com/?s=".$fixed_title."&r=json";

		//make request to the url 
		$response = file_get_contents($url);

		//decode the incoming json
		$results = json_decode($response);

		//to count how many objects are returned with search query, store this variable to acll later
		$new_res = $results->Search;

		//results to loop thru stored under object name search
		$data['search'] = $results;

		//used to count how many objects are in the results array returned by the API
		$data['new'] = $new_res;

		// //To show what the user entered on the search page
		// //grabbing value passed thru search
		$data['query'] = $title;

		//return the rendered result view and pass our data to the view
		return View::make('results', $data);
	}


	//details controller
	//passing thru imdbID collected from movie clicked on
	public function details ($imdbID){
		//make new data array
		$data = array();

		//url for details page
		$url= "http://www.omdbapi.com/?i=".$imdbID."&r=json" ;

		//response from API
		$response = file_get_contents($url);

		//decode incoming json
		$results = json_decode($response);

		// var_dump($results);

		//detail results for specific movie stored into array
		$data['info'] = $results;
		$data['imdbID'] = $imdbID;

		Session::put('info', $results);
 		
 		//render details view
		return View::make('details', $data);

	}

	//login controller
	//login function
	public function login () {

		//new empty data array
		$data = array();

		//grab username and password entered when form is triggered by post
		$username = Input::get('username');
		$password = Input::get('password');

		//database query
		//SELECT * FROM users WHERE username = username AND password = password
		$results = DB::table('users')
            	->where('username', $username)
            	->where('password' , $password)
            	->get();

    	//if the results are not empty
        //in other words, if there is an exact match
    	if($results != []){

    		//store thier username into a session
    		Session::put('user', $results[0]);

    		//store username into data object
    		$data['user'] = Session::get('user');

    		//query database for user's favorites
    		$query = DB::table('users')
    			//join favorites table
            	->join('favorites', 'users.id', '=', 'favorites.userid')
            	//select username and movie id
            	->select('users.username', 'favorites.movietitle', 'favorites.moviegenre')
            	//where user id current user id logged in
            	->where('users.id', '=', $data['user']->id)
            	->get();
    		
            // Session::put('query', $query);
            //store query into data object to be passed
    		$data['query'] = $query;
    			
    			// var_dump($query);
    		// point them to dashboard
    		return View::make('dashboard', $data);
    	}else{
    		$data['user'] = $username;

    		//otherwise tell them they messed up
    		return View::make('loginfail', $data);
    	}

	}

	//sign up function
	public function register () {
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
    		DB::table('users')->insertGetId(
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

	}

	//logout function
	public function logout (){
		//clear session of logged in user
		Session::flush();


		//should return NULL
		// $username = Session::get('username');

		//point them back to index
		return Redirect::to('/');
	}


	//displaying dashboard
	public function dashboard(){
		//new data array
		$data = array();
		$data['user'] = Session::get('user');

		//query database for user's favorites
    		$query = DB::table('users')
    			//join favorites table
            	->join('favorites', 'users.id', '=', 'favorites.userid')
            	//select username and movie id
            	->select('users.username', 'favorites.movietitle', 'favorites.moviegenre')
            	//where user id current user id logged in
            	->where('users.id', '=', $data['user']->id)
            	->get();

		//get session info
		$data['query'] = $query;
	
		//pass everything to the rendered page
		return View::make('dashboard', $data);
	}


	//adding a fav movie
	public function addFavorite($imdbID){
		//empty object for data
		$data = array();

		//url for details of movie
		$url= "http://www.omdbapi.com/?i=".$imdbID."&r=json" ;

		//response from API
		$response = file_get_contents($url);

		//decode incoming json
		$results = json_decode($response);

		//get user and movie details results
		$data['user'] = Session::get('user');
		$data['info'] = $results;

		//put info into favorites data table
		DB::table('favorites')->insertGetId(
    		array('userid' => $data['user']->id, 
    			'movieid' => $data['info']->imdbID,
    			'movietitle' => $data['info']->Title,
    			'moviegenre' => $data['info']->Genre

    			)
		);

		//point them to next page
		return View::make('/fav', $data);
	}


}//end of controller file
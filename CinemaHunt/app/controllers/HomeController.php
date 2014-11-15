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
 
		return View::make('details', $data);

	}

}

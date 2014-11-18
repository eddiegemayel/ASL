<?php

class HomeController extends BaseController {

 	//----------------------------------------------------------------------------------------------results function
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

		//if error exists
		if(isset($results->Response)){
			//display error to users
			$data['error'] = $results;
			//show them error page
			return View::make('noresults', $data);
		}else{
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

	}


	//----------------------------------------------------------------------------------------------details controller
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

		//detail results into session just in case?
		Session::put('info', $results);
 		
 		//render details view
		return View::make('details', $data);

	}

	//login controller
	//----------------------------------------------------------------------------------------------login function
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
            	->select('users.username', 'favorites.movietitle', 'favorites.moviegenre', 'favorites.movieid', 'favorites.movieyear', 'favorites.id')
            	//where user id current user id logged in
            	->where('users.id', '=', $data['user']->id)
            	->get();
    		
          
			//store query into data object to be passed
			$data['query'] = $query;

			//count users' favorites
			$count = count($data['query'], COUNT_RECURSIVE);

			//count passed to data
			$data['count'] = $count;

		//if they have favorites
		if($count != 0){
			//select random title to base recommendations off of
			$title_int1 = rand(1,$count);
			//subtract one so there is no errors
			$title_int1 = $title_int1 - 1 ;

			$title_int2 = rand(1, $count);
			$title_int2 = $title_int2 - 1;

			//replace empty spaces in that string with %20 so the API URL doesn't get mad
			$title1= str_replace(" ", "%20", $data['query'][$title_int1]->movietitle);
			$title2= str_replace(" ", "%20", $data['query'][$title_int2]->movietitle);

			//explode all words of the random title into an array
			$arr1 = explode('%20',trim($title1));
			$arr2 = explode('%20',trim($title2));
			//array length count
			$arrLength1 = count($arr1, COUNT_RECURSIVE);
			$arrLength2 = count($arr2, COUNT_RECURSIVE);
			//random array number minus 1 so there will be no errors
			$arrRand1 = rand(1, $arrLength1);
			$arrRand1 = $arrRand1 - 1;

			$arrRand2 = rand(1, $arrLength2);
			$arrRand2 = $arrRand2 - 1;

			//connect to find similar movies
			//Array of words with random word in the array selected to search by 
			$url1 = "http://www.omdbapi.com/?s=".$arr1[$arrRand1]."&r=json";
			$url2 = "http://www.omdbapi.com/?s=".$arr2[$arrRand2]."&r=json";

			//make request to the url 
			$response1 = file_get_contents($url1);
			$response2 = file_get_contents($url2);

			//decode the incoming json
			$results1 = json_decode($response1);
			$results2 = json_decode($response2);

			//if there are results to return
			if(isset($results1->Search) && isset($results2->Search)){
				//count the search results
				$search_count1 = count($results1->Search, COUNT_RECURSIVE);
				$search_count2 = count($results2->Search, COUNT_RECURSIVE);

				//random recommended number minus 1
				$int1 =  rand ( 1 , $search_count1 );
				$int1 = $int1 - 1 ;

				$int2 =  rand ( 1 , $search_count2 );
				$int2 = $int2 - 1 ;

				//store random recommended
				$data['rec1'] = $results1->Search[$int1];
				$data['rec2'] = $results2->Search[$int2];

				//return view
				return View::make('dashboard', $data);
				// return Redirect::to('dashboard', $data);

			}else{
				//show error page just in case something goes wrong
				return View::make('404');
			}

		}else{

			//if no favorites just render dashboard
			//pass everything to the rendered page
			return View::make('dashboard', $data);
		}


    	}else{
    		$data['user'] = $username;

    		//otherwise tell them they messed up
    		return View::make('loginfail', $data);
    	}

	}

	//----------------------------------------------------------------------------------------------sign up function
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


	//----------------------------------------------------------------------------------------------displaying dashboard
	public function dashboard(){
		//new data array
		$data = array();
		$data['user'] = Session::get('user');

		//query database for user's favorites
    	$query = DB::table('users')
    		//join favorites table
            ->join('favorites', 'users.id', '=', 'favorites.userid')
            //select username and movie id
            ->select('users.username', 'favorites.movietitle', 'favorites.moviegenre', 'favorites.movieid', 'favorites.movieyear', 'favorites.id')
            //where user id current user id logged in
            ->where('users.id', '=', $data['user']->id)
            ->get();

		//get session info
		$data['query'] = $query;

		//count how many favorites they have
		$count = count($data['query'], COUNT_RECURSIVE);

		//store count in the data to refer to it in the view later
		$data['count'] = $count;

		//if they have favorites
		if($count != 0){
			//select random title to base recommendations off of
			$title_int1 = rand(1,$count);
			//subtract one so there is no errors
			$title_int1 = $title_int1 - 1 ;

			$title_int2 = rand(1, $count);
			$title_int2 = $title_int2 - 1;

			//replace empty spaces in that string with %20 so the API URL doesn't get mad
			$title1= str_replace(" ", "%20", $data['query'][$title_int1]->movietitle);
			$title2= str_replace(" ", "%20", $data['query'][$title_int2]->movietitle);

			//explode all words of the random title into an array
			$arr1 = explode('%20',trim($title1));
			$arr2 = explode('%20',trim($title2));
			//array length count
			$arrLength1 = count($arr1, COUNT_RECURSIVE);
			$arrLength2 = count($arr2, COUNT_RECURSIVE);
			//random array number minus 1 so there will be no errors
			$arrRand1 = rand(1, $arrLength1);
			$arrRand1 = $arrRand1 - 1;

			$arrRand2 = rand(1, $arrLength2);
			$arrRand2 = $arrRand2 - 1;

			//connect to find similar movies
			//Array of words with random word in the array selected to search by 
			$url1 = "http://www.omdbapi.com/?s=".$arr1[$arrRand1]."&r=json";
			$url2 = "http://www.omdbapi.com/?s=".$arr2[$arrRand2]."&r=json";

			//make request to the url 
			$response1 = file_get_contents($url1);
			$response2 = file_get_contents($url2);

			//decode the incoming json
			$results1 = json_decode($response1);
			$results2 = json_decode($response2);

			//if there are results to return
			if(isset($results1->Search) && isset($results2->Search)){
				//count the search results
				$search_count1 = count($results1->Search, COUNT_RECURSIVE);
				$search_count2 = count($results2->Search, COUNT_RECURSIVE);

				//random recommended number minus 1
				$int1 =  rand ( 1 , $search_count1 );
				$int1 = $int1 - 1 ;

				$int2 =  rand ( 1 , $search_count2 );
				$int2 = $int2 - 1 ;

				//store random recommended
				$data['rec1'] = $results1->Search[$int1];
				$data['rec2'] = $results2->Search[$int2];

				//return view
				return View::make('dashboard', $data);

			}else{
				//show error page just in case something goes wrong
				return View::make('404');
			}

		}else{

			//if no favorites just render dashboard
			//pass everything to the rendered page
			return View::make('dashboard', $data);
		}

	}


	//----------------------------------------------------------------------------------------------adding a fav movie
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
    			'moviegenre' => $data['info']->Genre,
    			'movieyear' => $data['info']->Year

    			)
		);

		//point them to next page
		return View::make('/fav', $data);
	}

	//----------------------------------------------------------------------------------------------remove fav
	public function remove($id){
		//remove movie where unique id equals unique id
		DB::table('favorites')->where('id', $id)->delete();
		// var_dump($id);
		return Redirect::to('dashboard');
	}

	//----------------------------------------------------------------------------------------------logout function
	public function logout (){
		//clear session of logged in user
		Session::flush();


		//should return NULL
		// $username = Session::get('username');

		//point them back to index
		return Redirect::to('/');
	}

}//end of controller file
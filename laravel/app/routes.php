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

Route::get('/', function()
{
	return View::make('home.index');
});


Route::post('/', function()
{
	$url = Input::get('url'); //http://tutsplus.com
	
	$v = Url::validate(array('url' => $url));
	if( $v !== true ) {
		return Redirect::to('/')->withErrors($v); 
	}

	// If url is already in the table, return it
	$record = Url::whereUrl($url)->first();

	if($record) {
		return View::make('home.result')->with('shortened', $record->shortened);
	}



	// Otherwise, add a new row, and return the shortend url
	$row = Url::create(array(
		'url' => $url,
		'shortened' => Url::get_unique_short_url()
	));
	
	// create a results view, and present the short url to the user
	if($row) {
		return View::make('home.result')->with('shortened', $row->shortened);
	}
});

// refer to any sequence of characters
Route::any('{all}', function($shortened)
{
	// query the DB for the row with that short url
	$row = Url::whereShortened($shortened)->first();

	// if not found, redirect to home page
	if(is_null($row)) return Redirect::to('/');

	// Otherwise, fetch the URL, and redirect
	return Redirect::to($row->url);

});

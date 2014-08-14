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
	$users = User::all();
	foreach ($users as $user) {
		echo $user->first_name . " " . $user->last_name . "<br />";
	}
});

Route::get('/create/user', function() {
	$user = new User;
	$user->first_name = 'Simon';
	$user->last_name  = 'Tapson';
	$user->email      = 'sitapson@gmail.com';
	$user->save();
});

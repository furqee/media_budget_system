<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Default Controller
Route::get('/', 'HomeController@index');
Route::post('/home/submit', 'HomeController@submit');
Route::get('/home/skin/{any?}', 'HomeController@getSkin');


Route::get('dashboard/import', 'DashboardController@getImport');
/* Auth & Profile */
Route::get('user/profile','UserController@getProfile');
Route::get('user/login','UserController@getLogin');
Route::get('user/register','UserController@getRegister');
Route::get('user/logout','UserController@getLogout');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/reset/{any?}','UserController@getReset');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/activation','UserController@getActivation');
// Social Login
Route::get('user/socialize/{any?}','UserController@socialize');
Route::get('user/autosocialize/{any?}','UserController@autosocialize');
//
Route::post('user/signin','UserController@postSignin');
Route::post('user/create','UserController@postCreate');
Route::post('user/saveprofile','UserController@postSaveprofile');
Route::post('user/savepassword','UserController@postSavepassword');
Route::post('user/doreset/{any?}','UserController@postDoreset');
Route::post('user/request','UserController@postRequest');

/* Posts & Blogs */
Route::get('posts','HomeController@posts');
Route::get('posts/{any}','HomeController@posts');
Route::post('posts/comment','HomeController@comment');
Route::get('posts/remove/{id?}/{id2?}/{id3?}','HomeController@remove');
// Start Routes for Notification 
Route::resource('notification','NotificationController');
Route::get('home/load','HomeController@getLoad');
Route::get('home/lang/{any}','HomeController@getLang');

Route::get('/set_theme/{any}', 'HomeController@set_theme');

Route::post('/utilized_amount', 'DigitaladsController@utlizedAmount');
Route::post('/approved_budget', 'DigitaladsController@approvedBudget');
Route::post('/approved_utilized_budget', 'DigitaladsController@approvedUtilizedBudget');
Route::post('/client_data', 'DashboardController@clientData');
Route::post('/final_budget', 'ProjectsbudgetController@finalBudget');
Route::post('/status_update', 'ProjectsbudgetController@status');

include('pages.php');


Route::resource('sximoapi','SximoapiController');

// Routes for  all generated Module
include('module.php');
// Custom routes  
$path = base_path().'/routes/custom/';
$lang = scandir($path);
foreach($lang as $value) {
	if($value === '.' || $value === '..') {continue;} 
	include( 'custom/'. $value );	
	
}
// End custom routes
Route::group(['middleware' => 'auth'], function () {
	Route::resource('dashboard','DashboardController');
});


Route::group(['namespace' => 'Sximo','middleware' => 'auth'], function () {
	// This is root for superadmin
		
		include('sximo.php');
		
});

Route::group(['namespace' => 'Core','middleware' => 'auth'], function () {

	include('core.php');

});


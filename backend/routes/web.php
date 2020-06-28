<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::group(['domain' => 'admin.localhost'], function () {
//     // Route:	:get('/login', function () {
//     Auth::routes();
//     // });
//     Route::get('/',function(){
//     	return "admin.";
//     });
// });
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/auth/redirect/{provider}', 'Auth\LoginController@redirect');
Route::get('/callback/{provider}', 'Auth\LoginController@callback');	
Route::get('/details','Auth\LoginController@details');
Route::get('/test',function(){
        $user = Auth::user(); 
        return response()->json(['success' => $user]); 
});
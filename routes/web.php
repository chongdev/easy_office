<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route for normal user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('/manageuser', 'user\UserController');
    Route::get('/profile', 'user\UserController@index');
    Route::get('/profile/update', 'user\UserController@edit');
    Route::resource('/leave', 'user\leaveController');
    Route::get('/leave', 'user\leaveController@index');
    
    
  
});
//Route for admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/dashboard', 'admin\AdminController@index');
        Route::resource('/manageuser', 'admin\AddUserController');
        Route::get('/manageuser/{id}/edit','AddUserController@edit');
        Route::get('/manageuser/delete/{id}', 'admin\AddUserController@delete');
    });
});

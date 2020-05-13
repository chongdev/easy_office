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
        Route::get('/manageuser/{id}/edit','admin\AddUserController@edit');
        Route::get('/manageuser/delete/{id}', 'admin\AddUserController@delete');
        Route::resource('/dashboard', 'admin\adminController');
        Route::get('/dashbord/{id}/edit','admin\adminController@edit');
        Route::get('/export/excel', 'admin\adminController@export'); 
        Route::get('/export', 'admin\PDFController@index'); 
        Route::get('/export/pdf', 'admin\PDFController@pdf');
        Route::get('/mainadmin', 'admin\AdminController@index');
        
       
    });
});

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

/*Route::get('/', function () {
    return view('welcome');
});*/



Auth::routes();

Route::get('/users', 'UserController@index');
Route::get('/admin', 'AdminController@index');

//TASK
Route::get('/task', 'TaskController@index');
Route::post('/task/create', 'TaskController@store');
Route::post('/task/update/{id}', 'TaskController@update');
Route::post('/task/delete/{id}', 'TaskController@delete');


Route::get('/logout', 'Auth\LoginController@logout');




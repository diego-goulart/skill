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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

	Route::group(['prefix' => 'role', 'as' => 'role.'], function (){

		Route::get('/', ['as' => 'index', 'uses' => 'RoleController@index']);
		Route::get('/add', ['as' => 'create', 'uses' => 'RoleController@create']);
		Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'RoleController@edit']);
		Route::post('/save', ['as' => 'store', 'uses' => 'RoleController@store']);
		Route::put('/update/{id}', ['as' => 'update', 'uses' => 'RoleController@update']);
		Route::get('/delete/{id}', ['as' => 'destroy', 'uses' => 'RoleController@destroy']);
	});


});

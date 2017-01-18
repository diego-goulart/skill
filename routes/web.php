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


Route::group(['middleware' => ['web', 'auth']], function (){

	Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

		Route::get('roles', ['as' => 'roles.index', 'uses' => 'Admin\RolesController@index']);
		Route::get('roles/new', ['as' => 'roles.create', 'uses' => 'Admin\RolesController@create']);
		Route::post('roles/store', ['as' => 'roles.store', 'uses' => 'Admin\RolesController@store']);
		Route::get('roles/edit/{id}', ['as' => 'roles.edit', 'uses' => 'Admin\RolesController@edit']);
		Route::put('roles/update/{id}', ['as' => 'roles.update', 'uses' => 'Admin\RolesController@update']);
		Route::get('roles/destroy/{id}', ['as' => 'roles.destroy', 'uses' => 'Admin\RolesController@destroy']);
		Route::get('roles/permissions/{id}', ['as' => 'roles.permissions', 'uses' => 'Admin\RolesController@permissions']);
		Route::post('roles/permissions/{id}/store', ['as' => 'roles.permissions.store', 'uses' => 'Admin\RolesController@storePermission']);
		Route::get('roles/permissions/{id}/revoke/{permission_id}', ['as' => 'roles.permissions.revoke', 'uses' => 'Admin\RolesController@revokePermission']);


		Route::get('permissions', ['as' => 'permissions.index', 'uses' => 'Admin\PermissionsController@index']);
		Route::get('permissions/new', ['as' => 'permissions.create', 'uses' => 'Admin\PermissionsController@create']);
		Route::post('permissions/store', ['as' => 'permissions.store', 'uses' => 'Admin\PermissionsController@store']);
		Route::get('permissions/edit/{id}', ['as' => 'permissions.edit', 'uses' => 'Admin\PermissionsController@edit']);
		Route::put('permissions/update/{id}', ['as' => 'permissions.update', 'uses' => 'Admin\PermissionsController@update']);
		Route::get('permissions/destroy/{id}', ['as' => 'permissions.destroy', 'uses' => 'Admin\PermissionsController@destroy']);

	});

});


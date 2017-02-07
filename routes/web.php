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


		Route::get('users', ['as' => 'users.index', 'uses' => 'Admin\UsersController@index']);
		Route::get('users/new', ['as' => 'users.create', 'uses' => 'Admin\UsersController@create']);
		Route::post('users/store', ['as' => 'users.store', 'uses' => 'Admin\UsersController@store']);
		Route::get('users/edit/{id}', ['as' => 'users.edit', 'uses' => 'Admin\UsersController@edit']);

		Route::put('users/update/{id}', ['as' => 'users.update', 'uses' => 'Admin\UsersController@update']);
		Route::put('users/savepwd/{id}', ['as' => 'users.savepwd', 'uses' => 'Admin\UsersController@saveReset']);
		Route::get('users/destroy/{id}', ['as' => 'users.destroy', 'uses' => 'Admin\UsersController@destroy']);
		Route::get('users/roles/{id}', ['as' => 'users.roles', 'uses' => 'Admin\UsersController@roles']);
		Route::post('users/roles/{id}/store', ['as' => 'users.roles.store', 'uses' => 'Admin\UsersController@storeRole']);
		Route::get('users/roles/{id}/revoke/{role_id}', ['as' => 'users.roles.revoke', 'uses' => 'Admin\UsersController@revokeRole']);
		Route::get('users/active/{id}', ['as' => 'users.active', 'uses' => 'Admin\UsersController@active']);
		Route::get('users/groups/{id}', ['as' => 'users.groups', 'uses' => 'Admin\UsersController@groups']);
		Route::post('users/groups/{id}/store', ['as' => 'users.groups.store', 'uses' => 'Admin\UsersController@storeGroup']);
		Route::get('users/groups/{id}/unsubscribe/{group_id}', ['as' => 'users.groups.unsubscribe', 'uses' => 'Admin\UsersController@unsubscribeGroup']);
        Route::get('users/resetpwd/{token}', ['as' => 'users.reset', 'uses' => 'Admin\UsersController@resetPassword']);
        Route::get('users/freeze/{token}', ['as' => 'users.freeze', 'uses' => 'Admin\UsersController@forceReset']);

		Route::get('groups', ['as' => 'groups.index', 'uses' => 'Admin\GroupsController@index']);
		Route::get('groups/new', ['as' => 'groups.create', 'uses' => 'Admin\GroupsController@create']);
		Route::post('groups/store', ['as' => 'groups.store', 'uses' => 'Admin\GroupsController@store']);
		Route::get('groups/edit/{id}', ['as' => 'groups.edit', 'uses' => 'Admin\GroupsController@edit']);
		Route::put('groups/update/{id}', ['as' => 'groups.update', 'uses' => 'Admin\GroupsController@update']);
		Route::get('groups/destroy/{id}', ['as' => 'groups.destroy', 'uses' => 'Admin\GroupsController@destroy']);



		Route::get('questions', ['as' => 'questions.index', 'uses' => 'Admin\QuestionsController@index']);
		Route::get('questions/new', ['as' => 'questions.create', 'uses' => 'Admin\QuestionsController@create']);
		Route::post('questions/store', ['as' => 'questions.store', 'uses' => 'Admin\QuestionsController@store']);
		Route::get('questions/edit/{id}', ['as' => 'questions.edit', 'uses' => 'Admin\QuestionsController@edit']);
		Route::put('questions/update/{id}', ['as' => 'questions.update', 'uses' => 'Admin\QuestionsController@update']);
		Route::get('questions/destroy/{id}', ['as' => 'questions.destroy', 'uses' => 'Admin\QuestionsController@destroy']);


		Route::get('reports', ['as' => 'reports.index', 'uses' => 'Admin\ReportsController@index']);
		Route::get('reports/new/{operador_id}', ['as' => 'reports.create', 'uses' => 'Admin\ReportsController@create']);
		Route::post('reports/store', ['as' => 'reports.store', 'uses' => 'Admin\ReportsController@store']);
		Route::get('reports/edit/{id}', ['as' => 'reports.edit', 'uses' => 'Admin\ReportsController@edit']);
		Route::get('reports/view/{id}', ['as' => 'reports.view', 'uses' => 'Admin\ReportsController@show']);
		Route::put('reports/update/{id}', ['as' => 'reports.update', 'uses' => 'Admin\ReportsController@update']);
		Route::get('reports/destroy/{id}', ['as' => 'reports.destroy', 'uses' => 'Admin\ReportsController@destroy']);
		Route::get('reports/sign/{id}', ['as' => 'reports.sign', 'uses' => 'Admin\ReportsController@sign']);


		Route::get('supervisors', ['as' => 'supervisors', 'uses' => 'Admin\SupervisorController@dashboard']);
		Route::get('supervisors/{id}', ['as' => 'supervisors.lider', 'uses' => 'Admin\SupervisorController@lider']);


		Route::get('supervisors', ['as' => 'supervisors', 'uses' => 'Admin\SupervisorController@dashboard']);
		Route::get('supervisors/{id}', ['as' => 'supervisors.lider', 'uses' => 'Admin\SupervisorController@lider']);

		Route::get('lider', ['as' => 'lider', 'uses' => 'Admin\LiderController@dashboard']);
		Route::get('lider/operador/{id}', ['as' => 'lider.operador', 'uses' => 'Admin\LiderController@operador']);
		Route::get('lider/report/create/{id}', ['as' => 'lider.reports.create', 'uses' => 'Admin\LiderController@createReport']);
		Route::get('lider/report/edit/{id}', ['as' => 'lider.reports.edit', 'uses' => 'Admin\LiderController@editReport']);
		Route::post('lider/reports/store', ['as' => 'lider.reports.store', 'uses' => 'Admin\LiderController@storeReport']);
		Route::put('lider/reports/update/{id}', ['as' => 'lider.reports.update', 'uses' => 'Admin\LiderController@updateReport']);
		Route::get('lider/reports/{id}/delete', ['as' => 'lider.reports.delete', 'uses' => 'Admin\LiderController@destroyReport']);


		Route::get('operador', ['as' => 'operador', 'uses' => 'Admin\OperadorController@dashboard']);
		Route::get('operador/reports/{id}', ['as' => 'operador.reports.view', 'uses' => 'Admin\OperadorController@show']);
	});

});


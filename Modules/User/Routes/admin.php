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
Route::get('login', 'AuthController@getLogin')->name('admin.login');
Route::post('login', 'AuthController@login')->name('admin.post_login');
Route::get('logout', 'AuthController@logout')->name('admin.logout');

Route::group(['prefix' => 'users', 'as' => 'admin.users.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'UserController@index',
		'middleware' => 'can:admin.users.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'UserController@create',
		'middleware' => 'can:admin.users.create',
	]);

	Route::post('user', [
		'as' => 'store',
		'uses' => 'UserController@store',
		'middleware' => 'can:admin.users.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'UserController@edit',
		'middleware' => 'can:admin.users.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'UserController@update',
		'middleware' => 'can:admin.users.edit',
	]);

	Route::post('destroys', [
		'as' => 'destroy',
		'uses' => 'UserController@destroy',
		'middleware' => 'can:admin.users.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'UserController@show',
		'middleware' => 'can:admin.users.show',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'UserController@status',
		'middleware' => 'can:admin.users.create',
	]);

	Route::get('{id}/change-password', [
		'as' => 'change_password',
		'uses' => 'UserController@changePass'
	]);

	Route::post('{id}/change-password', [
		'as' => 'post_change_password',
		'uses' => 'UserController@savePass'
	]);
});

Route::group(['prefix' => 'account', 'as' => 'admin.account.'], function () {
	Route::get('profile', [
		'as' => 'profile',
		'uses' => 'AccountController@profile',
	]);

	Route::post('profile', [
		'as' => 'post_profile',
		'uses' => 'AccountController@updateProfile',
	]);

	Route::get('change-password', [
		'as' => 'change_password',
		'uses' => 'AccountController@changePassword',
	]);

	Route::post('change-password', [
		'as' => 'post_change_password',
		'uses' => 'AccountController@updatePassword',
	]);
});

Route::group(['prefix' => 'role', 'as' => 'admin.roles.'], function () {
	Route::get('/', [
		'as' => 'index',
		'uses' => 'RoleController@index',
		'middleware' => 'can:admin.roles.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'RoleController@create',
		'middleware' => 'can:admin.roles.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'RoleController@store',
		'middleware' => 'can:admin.roles.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'RoleController@edit',
		'middleware' => 'can:admin.roles.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'RoleController@status',
		'middleware' => 'can:admin.roles.create',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'RoleController@update',
		'middleware' => 'can:admin.roles.edit',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'RoleController@destroy',
		'middleware' => 'can:admin.roles.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'RoleController@show',
		'middleware' => 'can:admin.roles.show',
	]);
});

Route::group(['prefix' => 'departments', 'as' => 'admin.departments.'], function () {
	Route::get('/', [
		'as' => 'index',
		'uses' => 'DepartmentController@index',
		'middleware' => 'can:admin.departments.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'DepartmentController@create',
		'middleware' => 'can:admin.departments.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'DepartmentController@store',
		'middleware' => 'can:admin.departments.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'DepartmentController@edit',
		'middleware' => 'can:admin.departments.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'DepartmentController@status',
		'middleware' => 'can:admin.departments.create',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'DepartmentController@update',
		'middleware' => 'can:admin.departments.edit',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'DepartmentController@destroy',
		'middleware' => 'can:admin.departments.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'DepartmentController@show',
		'middleware' => 'can:admin.departments.show',
	]);
});

Route::group(['prefix' => 'positions', 'as' => 'admin.positions.'], function () {
	Route::get('/', [
		'as' => 'index',
		'uses' => 'PositionController@index',
		'middleware' => 'can:admin.positions.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'PositionController@create',
		'middleware' => 'can:admin.positions.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'PositionController@store',
		'middleware' => 'can:admin.positions.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'PositionController@edit',
		'middleware' => 'can:admin.positions.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'PositionController@status',
		'middleware' => 'can:admin.positions.create',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'PositionController@update',
		'middleware' => 'can:admin.positions.edit',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'PositionController@destroy',
		'middleware' => 'can:admin.positions.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'PositionController@show',
		'middleware' => 'can:admin.positions.show',
	]);
});

Route::prefix('employees')->group(function() {
	Route::get('/', 'EmployeeController@index');
});
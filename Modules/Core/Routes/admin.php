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

Route::prefix('categories/{code}')->group(function() {
	Route::get('', 'CategoryController@index')->name('admin.categories.index');
	Route::post('', [
		'as' => 'admin.categories.index',
		'uses' => 'CategoryController@table',
		'middleware' => 'can:admin.categories.index',
	]);
	Route::get('create', [
		'as' => 'admin.categories.create',
		'uses' => 'CategoryController@create',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::post('store', [
		'as' => 'admin.categories.store',
		'uses' => 'CategoryController@store',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.categories.edit',
		'uses' => 'CategoryController@edit',
		'middleware' => 'can:admin.categories.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.categories.update',
		'uses' => 'CategoryController@update',
		'middleware' => 'can:admin.categories.edit',
	]);

	Route::post('status', [
		'as' => 'admin.categories.status',
		'uses' => 'CategoryController@status',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.categories.destroy',
		'uses' => 'CategoryController@destroy',
		'middleware' => 'can:admin.categories.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.categories.show',
		'uses' => 'CategoryController@show',
		'middleware' => 'can:admin.categories.show',
	]);

	Route::post('save-arrange', [
		'as' => 'admin.categories.save_arrange',
		'uses' => 'CategoryController@saveArrange',
		// 'middleware' => 'can:admin.menus.edit',
	]);

});

Route::prefix('groups/{code}')->group(function() {
	Route::get('', 'GroupController@index')->name('admin.groups.index');
	Route::post('', [
		'as' => 'admin.groups.index',
		'uses' => 'GroupController@table',
		'middleware' => 'can:admin.groups.index',
	]);
	Route::get('create', [
		'as' => 'admin.groups.create',
		'uses' => 'GroupController@create',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('store', [
		'as' => 'admin.groups.store',
		'uses' => 'GroupController@store',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.groups.edit',
		'uses' => 'GroupController@edit',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.groups.update',
		'uses' => 'GroupController@update',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('status', [
		'as' => 'admin.groups.status',
		'uses' => 'GroupController@status',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.groups.destroy',
		'uses' => 'GroupController@destroy',
		'middleware' => 'can:admin.groups.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.groups.show',
		'uses' => 'GroupController@show',
		'middleware' => 'can:admin.groups.show',
	]);
});
Route::prefix('group-type/{code}')->group(function() {
	Route::get('', 'GroupTypeController@index')->name('admin.group_types.index');
	Route::post('', [
		'as' => 'admin.group_types.index',
		'uses' => 'GroupTypeController@table',
		'middleware' => 'can:admin.group_types.index',
	]);
	Route::get('create', [
		'as' => 'admin.group_types.create',
		'uses' => 'GroupTypeController@create',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('store', [
		'as' => 'admin.group_types.store',
		'uses' => 'GroupTypeController@store',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.group_types.edit',
		'uses' => 'GroupTypeController@edit',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.group_types.update',
		'uses' => 'GroupTypeController@update',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('status', [
		'as' => 'admin.group_types.status',
		'uses' => 'GroupTypeController@status',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.group_types.destroy',
		'uses' => 'GroupTypeController@destroy',
		'middleware' => 'can:admin.group_types.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.group_types.show',
		'uses' => 'GroupTypeController@show',
		'middleware' => 'can:admin.group_types.show',
	]);
});

Route::prefix('units/{code}')->group(function() {
	Route::get('', 'UnitController@index')->name('admin.units.index');
	Route::post('', [
		'as' => 'admin.units.index',
		'uses' => 'UnitController@table',
		'middleware' => 'can:admin.units.index',
	]);
	Route::get('create', [
		'as' => 'admin.units.create',
		'uses' => 'UnitController@create',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('store', [
		'as' => 'admin.units.store',
		'uses' => 'UnitController@store',
		'middleware' => 'can:admin.units.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.units.edit',
		'uses' => 'UnitController@edit',
		'middleware' => 'can:admin.units.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.units.update',
		'uses' => 'UnitController@update',
		'middleware' => 'can:admin.units.edit',
	]);

	Route::post('status', [
		'as' => 'admin.units.status',
		'uses' => 'UnitController@status',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.units.destroy',
		'uses' => 'UnitController@destroy',
		'middleware' => 'can:admin.units.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.units.show',
		'uses' => 'UnitController@show',
		'middleware' => 'can:admin.units.show',
	]);
});

Route::prefix('setting')->group(function() {
	Route::get('admin-app', [
		'as' => 'admin.settings.admin_app',
		'uses' => 'AdminAppController@adminApp',
	]);

	Route::post('admin-app', [
		'as' => 'admin.settings.admin_app',
		'uses' => 'AdminAppController@updateAdminApp',
	]);

	Route::get('package', [
		'as' => 'admin.settings.package',
		'uses' => 'PackageController@index',
	]);

	Route::post('package', [
		'as' => 'admin.settings.package',
		'uses' => 'PackageController@package',
	]);

	Route::post('save', [
		'as' => 'admin.settings.save',
		'uses' => 'SettingController@save',
	]);

	Route::get('{key}', [
		'as' => 'admin.settings.index',
		'uses' => 'SettingController@index',
	]);
});

Route::prefix('tabs/{code}')->group(function() {
	Route::get('', 'TabController@index')->name('admin.tabs.index');
	Route::post('', [
		'as' => 'admin.tabs.index',
		'uses' => 'TabController@table',
		'middleware' => 'can:admin.tabs.index',
	]);

	Route::post('store', [
		'as' => 'admin.tabs.store',
		'uses' => 'TabController@store',
		'middleware' => 'can:admin.tabs.index',
	]);

	Route::post('destroy', [
		'as' => 'admin.tabs.destroy',
		'uses' => 'TabController@destroy',
		'middleware' => 'can:admin.tabs.destroy',
	]);

	Route::post('destroy', [
		'as' => 'admin.tabs.destroy',
		'uses' => 'TabController@destroy',
		'middleware' => 'can:admin.tabs.destroy',
	]);

	Route::post('sort', [
		'as' => 'admin.tabs.sort',
		'uses' => 'TabController@sort',
		'middleware' => 'can:admin.tabs.index',
	]);
});

Route::prefix('apps')->group(function() {
	Route::get('', 'AppController@index')->name('admin.apps.index');

	Route::post('install', [
		'as' => 'admin.apps.install',
		'uses' => 'AppController@install',
	]);

	Route::post('uninstall', [
		'as' => 'admin.apps.uninstall',
		'uses' => 'AppController@uninstall',
	]);
});

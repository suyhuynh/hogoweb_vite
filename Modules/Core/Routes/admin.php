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

Route::get('/', 'AdminController@index')->name('admin.dashboard.index');

Route::group(['prefix' => 'config', 'as' => 'admin.config.'], function () {
    Route::get('{key?}', [
        'as' => 'index',
        'uses' => 'ConfigController@index',
        'middleware' => 'can:admin.config.index',
    ]);

    Route::post('{key}', [
        'as' => 'store',
        'uses' => 'ConfigController@store',
        'middleware' => 'can:admin.config.index',
    ]);
});

Route::group(['prefix' => 'categories/{code}', 'as' => 'admin.categories.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'CategoryController@table',
		'middleware' => 'can:admin.categories.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'CategoryController@create',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'CategoryController@store',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'CategoryController@edit',
		'middleware' => 'can:admin.categories.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'CategoryController@update',
		'middleware' => 'can:admin.categories.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'CategoryController@status',
		'middleware' => 'can:admin.categories.create',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'CategoryController@destroy',
		'middleware' => 'can:admin.categories.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'CategoryController@show',
		'middleware' => 'can:admin.categories.show',
	]);

	Route::post('save-arrange', [
		'as' => 'save_arrange',
		'uses' => 'CategoryController@saveArrange',
		// 'middleware' => 'can:admin.menus.edit',
	]);

});

Route::group(['prefix' => 'groups/{code}', 'as' => 'admin.groups.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'GroupController@index',
		'middleware' => 'can:admin.groups.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'GroupController@create',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'GroupController@store',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'GroupController@edit',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'GroupController@update',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'GroupController@status',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'GroupController@destroy',
		'middleware' => 'can:admin.groups.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'GroupController@show',
		'middleware' => 'can:admin.groups.show',
	]);
});

Route::group(['prefix' => 'group-type/{code}', 'as' => 'admin.group_types.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'GroupTypeController@index',
		'middleware' => 'can:admin.group_types.index',
	]);
	Route::get('create', [
		'as' => 'create',
		'uses' => 'GroupTypeController@create',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'GroupTypeController@store',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'GroupTypeController@edit',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'GroupTypeController@update',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'GroupTypeController@status',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'GroupTypeController@destroy',
		'middleware' => 'can:admin.group_types.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'GroupTypeController@show',
		'middleware' => 'can:admin.group_types.show',
	]);
});

Route::group(['prefix' => 'units/{code}', 'as' => 'admin.units.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'UnitController@index',
		'middleware' => 'can:admin.units.index',
	]);

	Route::get('create', [
		'as' => 'create',
		'uses' => 'UnitController@create',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'UnitController@store',
		'middleware' => 'can:admin.units.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'edit',
		'uses' => 'UnitController@edit',
		'middleware' => 'can:admin.units.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'update',
		'uses' => 'UnitController@update',
		'middleware' => 'can:admin.units.edit',
	]);

	Route::post('status', [
		'as' => 'status',
		'uses' => 'UnitController@status',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'UnitController@destroy',
		'middleware' => 'can:admin.units.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'show',
		'uses' => 'UnitController@show',
		'middleware' => 'can:admin.units.show',
	]);
});

Route::group(['prefix' => 'setting', 'as' => 'admin.settings.'], function () {
	Route::get('admin-app', [
		'as' => 'admin_app',
		'uses' => 'AdminAppController@adminApp',
	]);

	Route::post('admin-app', [
		'as' => 'post_admin_app',
		'uses' => 'AdminAppController@updateAdminApp',
	]);

	Route::get('package', [
		'as' => 'package',
		'uses' => 'PackageController@index',
	]);

	Route::post('package', [
		'as' => 'post_package',
		'uses' => 'PackageController@package',
	]);

	Route::post('save', [
		'as' => 'save',
		'uses' => 'SettingController@save',
	]);

	Route::get('{key}', [
		'as' => 'index',
		'uses' => 'SettingController@index',
	]);
});

Route::group(['prefix' => 'tabs', 'as' => 'admin.tabs.'], function () {
	Route::get('', [
		'as' => 'index',
		'uses' => 'TabController@index',
		'middleware' => 'can:admin.tabs.index',
	]);

	Route::post('store', [
		'as' => 'store',
		'uses' => 'TabController@store',
		'middleware' => 'can:admin.tabs.index',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'TabController@destroy',
		'middleware' => 'can:admin.tabs.destroy',
	]);

	Route::post('destroy', [
		'as' => 'destroy',
		'uses' => 'TabController@destroy',
		'middleware' => 'can:admin.tabs.destroy',
	]);

	Route::post('sort', [
		'as' => 'sort',
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
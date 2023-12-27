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

Route::get('/', [
	'as' => 'web.home',
	'uses' => 'Website\IndexController@index',
]);

Route::get('default', [
	'as' => 'web.default',
	'uses' => 'Website\IndexController@default',
]);

Route::get('demo', [
	'as' => 'web.demo',
	'uses' => 'Website\IndexController@demo',
]);

Route::get('change/{code}', [
	'as' => 'web.language',
	'uses' => 'Website\IndexController@changeLanguage',
]);

Route::get('themes/edit', 'EditThemeController@index')->name('web.edit');
Route::get('/sitemap.xml', 'Website\SeoController@sitemap')->name('web.sitemap');
Route::get('/sitemap-{key}.xml', 'Website\SeoController@sitemapKey')->name('web.sitemap_key');
Route::get('/robots.txt', 'Website\SeoController@robots')->name('web.robots');
Route::get('/feed', 'Website\SeoController@feed')->name('web.feed');

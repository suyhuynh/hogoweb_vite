<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clear', function() {
	\Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');

    \Cache::forget('translator');
    \Artisan::call('view:cache');
    \Artisan::call('optimize');
    \Artisan::call('route:cache');
	return "Cleared!";
})->name('api.clear');

Route::get('/install', function() {
	\Artisan::call('migrate');
	return "done";
})->name('api.install');

Route::get('/schedule', function() {
	\Artisan::call('schedule:run');
	return "done";
})->name('api.schedule');

Route::get('/update-module', function() {
	$data = json_decode(file_get_contents(base_path('modules_statuses.json')), true);
    $array = [];
    foreach($data as $key => $val) {
        if ($val == true) {
            $array[] = $key;
        }
    }
    \Modules\Core\Entities\Config::updateOrCreate([
        'type' => 'module'
    ],[
        'id' => 1,
        'type' => 'module',
        'config' => $array
    ]);
	return "done";
})->name('api.update_module');

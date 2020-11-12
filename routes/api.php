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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* Todo */
Route::prefix('todos')->group(function () {

	// Get List
	Route::get('/', ['uses' => 'App\Http\Controllers\TodoController@list']);

	// get Details
	Route::get('/{id}', ['uses' => 'App\Http\Controllers\TodoController@show']);

	// Create Statuses
	Route::post('/', ['uses' => 'App\Http\Controllers\TodoController@create']);

	// Create Bulk Statuses
	Route::post('/bulk/create', ['uses' => 'App\Http\Controllers\TodoController@create_bulk']);

	// Restore Statuses
	Route::put('/{id}', ['uses' => 'App\Http\Controllers\TodoController@update']);

	// Delete Statuses
	Route::delete('/delete', ['uses' => 'App\Http\Controllers\TodoController@delete']);
});

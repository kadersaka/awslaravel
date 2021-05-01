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
/*
Route::post('trustcompanylogo', 'TrustedLogoController@store');
Route::get('getfile', 'TrustedLogoController@show');
*/
Route::prefix('file')->group(function(){
    Route::post('/store', 'TrustedLogoController@store');
    Route::get('/read', 'TrustedLogoController@show');
    Route::delete('/delete', 'TrustedLogoController@destroy');
});
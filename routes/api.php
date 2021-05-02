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
/**
 * Genral File no encryption
 */
Route::prefix('file')->group(function(){
    Route::post('/store', 'TrustedLogoController@store');
    Route::get('/read/{trustedLogo}', 'TrustedLogoController@show');
    Route::get('/temporarlink/{trustedLogo}', 'TrustedLogoController@temporarlink');
    Route::delete('/delete/{trustedLogo}', 'TrustedLogoController@destroy');
});

/**
 * Images files with encryption
 */
Route::prefix('secureimages')->group(function(){
    Route::post('/store', 'SecureImageController@store');
    Route::get('/read/{trustedLogo}', 'SecureImageController@show');
    Route::get('/temporarlink/{trustedLogo}', 'SecureImageController@temporarlink');
    Route::delete('/delete/{trustedLogo}', 'SecureImageController@destroy');
});
/**
 * video files with encryption
 */
Route::prefix('securevideos')->group(function(){
    Route::get('/uuid', 'VideoImageController@index');
    Route::post('/store', 'VideoImageController@store');
    Route::get('/read/{trustedLogo}', 'VideoImageController@show');
    Route::get('/temporarlink/{trustedLogo}', 'VideoImageController@temporarlink');
    Route::delete('/delete/{trustedLogo}', 'VideoImageController@destroy');
});
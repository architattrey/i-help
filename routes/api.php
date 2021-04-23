<?php

use Illuminate\Http\Request;

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

Route::get('/get-all-languages','ApiController@getLanguages');
Route::get('/get-all-medical-type','ApiController@getMedicalType');
Route::post('/get-all-videos','ApiController@getVideos');
Route::post('/get-all-blogs','ApiController@getBlogs');
Route::post('/search-medical-type','ApiController@searchMedicalType');
Route::post('/get-questions','ApiController@getQuestions');
 
Route::post('/get-answer','ApiController@getAnswer');
Route::post('/login','ApiController@login');
Route::post('/upload-image','ApiController@imageUpload');
Route::post('/update-firebase-token','ApiController@updateFireBaseToken');
Route::post('/update-user-profile','ApiController@appUserProfileUpdate');
Route::post('/submit-transaction','ApiController@submitTransaction');
// Route::post('/old-transactions','ApiController@oldTransactions');
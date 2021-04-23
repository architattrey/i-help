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

Route::get('/storagess', function () {
    Artisan::call('cache:clear');
    return "yooo";
});
Route::get('/', function () {
    // return url('/login');
    return redirect()->route('login');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::post('login-dashboard','AdminController@login')->name('login-dashboard');
Route::get('dashboard','AdminController@index')->name('dashboard');
Route::get('/languages','AdminController@languageActions')->name('languages');
Route::get('/medical-type','AdminController@medicalTypeActions')->name('medical-type');
Route::get('user-actions','AdminController@getUsers')->name('user-actions');
Route::get('transactions-actions','AdminController@getTransactions')->name('transactions-actions');
Route::get('blogs-actions','AdminController@getBlogs')->name('blogs-actions');
Route::get('videos-actions','AdminController@getVideos')->name('videos-actions');
Route::get('questions-actions','AdminController@getQuestions')->name('questions-actions');
Route::get('answer-actions','AdminController@getAnswers')->name('answer-actions');
 


#ajax routing 
Route::post('image-upload','AjaxController@imageUpload');

#language
Route::get('get-languages','AjaxController@getLanguages');
Route::post('add-update-language','AjaxController@addUpdateLanguages');
Route::post('delete-language','AjaxController@deleteLanguages');

#medical type
Route::get('get-medical-type','AjaxController@getMedicalType');
Route::post('add-update-medical-type','AjaxController@addUpdateMedicalType');
Route::post('delete-medical-type','AjaxController@deleteMedicalType');

#user
Route::post('get-users','AjaxController@getUsers');
Route::post('delete-user','AjaxController@deleteUser');
Route::post('show-transactions','AjaxController@showTransactions');

#transactions
Route::get('get-transactions','AjaxController@getTransactions');

#blogs
Route::get('get-blogs','AjaxController@getBlogs');
Route::post('delete-blog','AjaxController@deleteBlog');
Route::post('add-update-blog','AjaxController@addUpdateBlog');

#videos
Route::post('video-upload','AjaxController@videoUpload');
Route::get('get-videos','AjaxController@getVideos');
Route::post('delete-video','AjaxController@deleteVideo');
Route::post('add-update-video','AjaxController@addUpdateVideo');

#questions

Route::get('get-questions','AjaxController@getAllQuestions');
Route::post('add-update-question','AjaxController@addUpdateQuestion');
Route::post('delete-question','AjaxController@deleteQuestion');

#answers
Route::get('get-answers','AjaxController@getAllAnswers');
Route::post('add-update-answer','AjaxController@addUpdateAnswer');
Route::post('delete-answer','AjaxController@deleteAnswer');
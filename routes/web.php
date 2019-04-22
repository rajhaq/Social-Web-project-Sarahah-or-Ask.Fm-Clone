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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/report', 'HomeController@report')->name('report');
Route::post('/report/store', 'HomeController@reportstore')->name('reportstore');
Route::get('/status/add', 'StatusController@add');
Route::post('/search', 'HomeController@search')->name('search');

Route::post('/status/store', 'StatusController@store')->name('status_store');
Route::get('/status/all', 'StatusController@all');
Route::get('/status/mystatus', 'StatusController@mystatus');
Route::get('/status/edit/{id}', 'StatusController@edit');
Route::get('/status/delete/{id}', 'StatusController@delete');
Route::post('/status/update', 'StatusController@update')->name('status_update');
Route::post('/status/comment', 'StatusController@comment')->name('status_comment');
Route::get('/status/heart/{id}', 'StatusController@heart')->name('status_heart');
Route::get('/status/heartdelete/{id}', 'StatusController@heart_delete')->name('status_heart_delete');
Route::get('/user/profile/{id}', 'ProfileController@profile');
Route::post('/question/store', 'QuestionController@store')->name('Question_store');
Route::get('/question/pendinglist', 'QuestionController@pendinglist');
Route::post('/question/answer', 'QuestionController@answer')->name('answer_store');
Route::get('/user/myprofile','ProfileController@myprofile');
Route::post('/profile','ProfileController@update_avatar');
Route::get('/status/heart/{id}','StatusController@heartadd');
Route::get('/view/status/{id}','ViewController@status');
Route::get('/view/question/{id}','ViewController@question');
Route::get('/notifications','ViewController@notifications');
Route::get('/user/settings','ProfileController@settings');
Route::post('/user/update_profile','ProfileController@update_profile')->name('update_profile');
Route::get('/status/comment/delete/{id}','StatusController@delete_comment');
Route::get('/question/myaskedquestion', 'QuestionController@myaskedquestions');
Route::get('/question/delete/{id}', 'QuestionController@delete_question');
Route::get('/user/password/reset', 'HomeController@reset');

//login
Route::post('/user/logged', 'HomeController@signin')->name('userin');
Route::post('/user/useradded', 'HomeController@signup')->name('userup');
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
Route::get('articles','IndexController@articles');

Route::post('upload/editor','UploadController@editorUpload')->name('upload.editor');
Route::post('/uploadFile', 'UploadController@uploadImg');

Route::group(['namespace'=>'home','prefix'=>'home'],function (){
    Route::resource('/','IndexController',['only'=>['index']]);
    Route::resource('page','PageController',['only'=>['index','show']]);
//    Route::resource('article','ArticleController',['only'=>['index','show']]);

    Route::group(['prefix'=>'article'],function(){
        Route::get('/','ArticleController@index')->name('home.article');
        Route::get('/{category}','ArticleController@index');
        Route::get('/{category}/{article}','ArticleController@show');
    });
});
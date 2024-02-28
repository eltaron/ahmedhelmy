<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {
    Route::get("relodBack", 'HomeController@relodBack');
    Route::get("", 'HomeController@index');
    Route::post('login', 'UserController@login');
    Route::get("Notfound", 'HomeController@Notfound');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', 'HomeController@dashboard');
        Route::get('logout', 'HomeController@logout');
        Route::group(['prefix' => 'lessons'], function () {
            Route::get('', 'LessonController@index');
            Route::get('show/{id}', 'LessonController@show');
            Route::post('store', 'LessonController@store');
            Route::post('store2', 'LessonController@store2');
            Route::post('update', 'LessonController@update');
            Route::post('delete', 'LessonController@destroy');
            Route::post('activate', 'LessonController@activate');
            Route::post('not_activiate', 'LessonController@not_activiate');
        });
        Route::group(['prefix' => 'members'], function () {
            Route::get('', 'UserController@index');
            Route::get('new', 'UserController@new');
            Route::get('old', 'UserController@old');
            Route::get('tops', 'UserController@tops');
            Route::get('show/{id}', 'UserController@show');
            Route::post('store', 'UserController@store');
            Route::post('destroy', 'UserController@destroy');
            Route::post('activate', 'UserController@activate');
            Route::post('top', 'UserController@top');
            Route::post('nottop', 'UserController@nottop');
            Route::post('update', 'UserController@update');
            Route::post('disabled_all', 'UserController@disabled_all');
            Route::post('not_activiate', 'UserController@not_activiate');
            Route::post('editCurrentUser', 'UserController@editCurrentUser');
            Route::post('addFromFile', 'UserController@addFromFile');
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('', 'CategoryController@index');
            Route::get('show/{id}', 'CategoryController@show');
            Route::post('store', 'CategoryController@store');
            Route::post('update', 'CategoryController@update');
            Route::post('delete', 'CategoryController@destroy');
            Route::post('activate', 'CategoryController@activate');
            Route::post('not_activate', 'CategoryController@not_activate');
        });
        Route::group(['prefix' => 'exams'], function () {
            Route::get('', 'ExamController@index');
            Route::get('show/{id}', 'ExamController@show');
            Route::get('part/{id}', 'ExamController@part');
            Route::get('partDescription/{id}', 'ExamController@partDescription');
            Route::post('store', 'ExamController@store');
            Route::post('store2', 'ExamController@store2');
            Route::post('store3', 'ExamController@store3');
            Route::post('delete', 'ExamController@destroy');
            Route::post('update', 'ExamController@update');
            Route::post('update2', 'ExamController@update2');
            Route::post('update3', 'ExamController@update3');
            Route::post('marks', 'ExamController@marks');
            Route::post('deleteAnswers/{id}', 'ExamController@deleteAnswers');
            Route::post('storeQuestion1', 'ExamController@storeQuestion1');
            Route::post('storeQuestion2', 'ExamController@storeQuestion2');
            Route::post('destroyQuestion', 'ExamController@destroyQuestion');

            Route::post('storePart', 'ExamController@storePart');
            Route::post('destroyPart', 'ExamController@destroyPart');

            Route::post('storePQuestion1', 'ExamController@storePQuestion1');
            Route::post('storePQuestion2', 'ExamController@storePQuestion2');
        });
        Route::group(['prefix' => 'articles'], function () {
            Route::get('', 'ArticleController@index');
            Route::get('free', 'ArticleController@free2');
            Route::get('notfree', 'ArticleController@notfree2');
            Route::get('show/{id}', 'ArticleController@show');
            Route::post('store', 'ArticleController@store');
            Route::post('update', 'ArticleController@update');
            Route::post('delete', 'ArticleController@destroy');
            Route::post('free', 'ArticleController@free');
            Route::post('notfree', 'ArticleController@notfree');
            Route::post('deleteImage', 'ArticleController@deleteImage');
        });
        Route::group(['prefix' => 'audios'], function () {
            Route::get('', 'AudioController@index');
            Route::post('store', 'AudioController@store');
            Route::post('update', 'AudioController@update');
            Route::post('delete', 'AudioController@destroy');
            Route::post('activate', 'AudioController@activate');
            Route::post('notactivate', 'AudioController@notactivate');
        });
        Route::group(['prefix' => 'posts'], function () {
            Route::get('', 'PostController@index');
            Route::get('show/{id}', 'PostController@show');
            Route::post('store', 'PostController@store');
            Route::post('update', 'PostController@update');
            Route::post('delete', 'PostController@destroy');
            Route::post('deleteImage', 'PostController@deleteImage');
        });
        Route::group(['prefix' => 'events'], function () {
            Route::get('', 'EventController@index');
            Route::post('store', 'EventController@store');
            Route::post('update', 'EventController@update');
            Route::post('delete', 'EventController@destroy');
        });
        Route::group(['prefix' => 'articleComments'], function () {
            Route::get('', 'ArticleController@comment');
            Route::post('destroy', 'ArticleController@destroy_comment');
            Route::post('activate', 'ArticleController@activate_comment');
        });
        Route::group(['prefix' => 'postComments'], function () {
            Route::get('', 'PostController@comment');
            Route::post('destroy', 'PostController@destroy_comment');
            Route::post('activiate', 'PostController@activate_comment');
        });
        Route::group(['prefix' => 'messages'], function () {
            Route::get('', 'MessageController@index');
            Route::post('destroy', 'MessageController@destroy');
        });
        Route::group(['prefix' => 'books'], function () {
            Route::get('', 'QuotesController@index');
            Route::post('store', 'QuotesController@store');
            Route::post('delete', 'QuotesController@destroy');
        });
        Route::group(['prefix' => 'live'], function () {
            Route::get('', 'LiveController@index');
            Route::post('destroy', 'LiveController@destroy');
            Route::post('store', 'LiveController@store');
        });
        Route::group(['prefix' => 'settings'], function () {
            Route::get('', 'UserController@settings');
        });
    });
});

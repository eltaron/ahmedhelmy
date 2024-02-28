<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', function () {
        Artisan::call('cache:clear');
        return redirect(url('home'));
    });
    Route::get("home", 'HomeController@index');
    Route::get("freelessons", 'HomeController@freelessons');
    Route::get("freearticles", 'HomeController@freearticles');
    Route::get("contactus", 'HomeController@contactus');
    Route::post("addMessage", 'HomeController@addMessage');

    Route::get("login", 'HomeController@login');
    Route::get("register", 'HomeController@register');
    Route::get("logout", 'AuthController@logout');
    Route::get("signupnow", 'AuthController@signupnow');

    Route::post("login", 'AuthController@login');
    Route::post("store", 'AuthController@store');

    Route::get("under_review/{code}", 'AuthController@under_review');
    Route::group(['prefix' => ''], function () {
    });
    Route::group(['middleware' => ['auth']], function () {
        Route::get("dashboard", 'CategoryController@index');
        Route::group(['prefix' => 'lessons'], function () {
            Route::get("lesson/{id}", 'LessonController@index');
            Route::post("addComment", 'LessonController@addComment');
            Route::post("startLesson", 'LessonController@startLesson');
            Route::post("endLesson", 'LessonController@endLesson');
            Route::get("isntAvailable", 'LessonController@isntAvailable');
        });
        Route::middleware('hotlink')->group(function () {
            Route::get("lessons/show/{id}", 'LessonController@show');
        });
        Route::group(['prefix' => 'exams'], function () {
            Route::get("exam/{id}", 'ExamController@index');
            Route::get("full_exam/{id}", 'ExamController@full_exam');
            Route::get("time_out", 'ExamController@time_out');
            Route::get("end/{id}", 'ExamController@end');
            Route::get("isntAvailable", 'ExamController@isntAvailable');
            Route::post("endFullExam/{id}", 'ExamController@endFullExam');
        });
        Route::group(['prefix' => 'posts'], function () {
            Route::get("", 'PostController@index');
            Route::post("addComment", 'PostController@addComment');
            Route::post("like", 'PostController@like');
        });
        Route::group(['prefix' => 'articles'], function () {
            Route::get("", 'ArticleController@index');
            Route::get("show/{id}", 'ArticleController@show');
            Route::post("addComment", 'ArticleController@addComment');
        });
        Route::get("events", 'EventController@index');
        Route::group(['prefix' => 'profile'], function () {
            Route::get("", 'UserController@index');
            Route::post("update", 'UserController@update');
            Route::post("avatar", 'UserController@avatar');
            Route::post("contact", 'UserController@contact');
        });
    });
});

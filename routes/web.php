<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm');

Route::post('/admin/login', 'Auth\AdminLoginController@Login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login');


Route::prefix('/admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth:admin')
    ->group(function(){
        Route::get('/', 'AdminDashboard@admin')->name('dashboard');


        Route::prefix('/admins')
            ->name('admins.')
            ->group(function(){
                Route::get('/', 'AdminController@index')->name('list');
                Route::get('/list', 'AdminController@list');
                Route::get('/register', 'AdminController@create')->name('register');
                Route::post('/register', 'AdminController@store');
                Route::get('/edit/{admin}', 'AdminController@show')->name('edit');
                Route::put('/edit/{admin}', 'AdminController@update');
                Route::delete('/delete/{admin}', 'AdminController@destroy');
            });

        Route::prefix('/teacher')
            ->name('teacher.')
            ->group(function(){
                Route::get('/', 'TeacherController@index')->name('list');
                Route::get('/list', 'TeacherController@list');
                Route::get('/courses/{teacher}', 'TeacherController@courses');
                Route::put('/courses/{teacher}/detach', 'TeacherController@detach');
                Route::get('/register', 'TeacherController@create')->name('register');
                Route::post('/register', 'TeacherController@store');
                Route::get('/edit/{teacher}', 'TeacherController@show')->name('edit');
                Route::put('/edit/{teacher}', 'TeacherController@update');
                Route::delete('/delete/{teacher}', 'TeacherController@destroy');
            });

        Route::prefix('/user')
            ->name('user.')
            ->group(function(){
                Route::get('/', 'UserController@index')->name('list');
                Route::get('/list', 'UserController@list');
                Route::get('/courses/{user}', 'UserController@courses');
                Route::put('/courses/{user}/detach', 'UserController@detach');
                Route::get('/register', 'UserController@create')->name('register');
                Route::post('/register', 'UserController@store');
                Route::get('/edit/{user}', 'UserController@show')->name('edit');
                Route::put('/edit/{user}', 'UserController@update');
                Route::delete('/delete/{user}', 'UserController@destroy');
            });

        Route::prefix('/course')
            ->name('course.')
            ->group(function(){
                Route::get('/', 'CourseController@index')->name('list');
                Route::get('/list', 'CourseController@list');
                Route::get('/register', 'CourseController@create')->name('register');
                Route::post('/register', 'CourseController@store');
                Route::get('/edit/{course}', 'CourseController@show')->name('edit');
                Route::put('/edit/{course}', 'CourseController@update');
                Route::delete('/delete/{course}', 'CourseController@destroy');
            });

        Route::prefix('/category')
            ->name('category.')
            ->group(function(){
                Route::get('/', 'CategoryController@index')->name('list');
                Route::get('/list', 'CategoryController@list');
                Route::get('/register', 'CategoryController@create')->name('register');
                Route::post('/register', 'CategoryController@store');
                Route::get('/edit/{category}', 'CategoryController@show')->name('edit');
                Route::put('/edit/{category}', 'CategoryController@update');
                Route::delete('/delete/{category}', 'CategoryController@destroy');
            });

        Route::prefix('/level')
            ->name('level.')
            ->group(function(){
                Route::get('/', 'LevelController@index')->name('list');
                Route::get('/list', 'LevelController@list');
                Route::get('/register', 'LevelController@create')->name('register');
                Route::post('/register', 'LevelController@store');
                Route::get('/edit/{level}', 'LevelController@show')->name('edit');
                Route::put('/edit/{level}', 'LevelController@update');
                Route::delete('/delete/{level}', 'LevelController@destroy');
            });
});
Route::prefix('/teacher')
    ->middleware('auth:teacher')
    ->name('teacher.')
    ->namespace('Teacher')
    ->group(function(){
        Route::get('/', 'TeacherDashboard@teacher');
        Route::get('/profile', 'TeacherDashboard@profile')->name('profile');
        Route::get('/courses', 'TeacherDashboard@courses')->name('courses');
});

Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/courses/list', 'HomeController@list');

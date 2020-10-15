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

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@Login');

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
                Route::post('/edit/{user}/associate', 'UserController@associate');
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
                Route::get('/edit/{course}/json', 'CourseController@showJson');
                Route::post('/edit/{course}', 'CourseController@update');
                Route::delete('/delete/{course}', 'CourseController@destroy');

                Route::get('/edit/{course}/activity', 'ActivityController@show');
                Route::get('/edit/{course}/activity/add', 'ActivityController@create')->name('activity');
                Route::post('/edit/{course}/activity/add', 'ActivityController@store');
                Route::get('/edit/activity/{activity}', 'ActivityController@edit');
                Route::get('/edit/activity/{activity}/material', 'ActivityController@getMaterial');
                Route::put('/edit/activity/{activity}', 'ActivityController@update');
                Route::delete('/edit/activity/delete/{activity}', 'ActivityController@destroy');

                Route::get('/edit/{course}/content', 'ContentController@show');
                Route::get('/edit/{course}/content/add', 'ContentController@create')->name('content');
                Route::post('/edit/{course}/content/add', 'ContentController@store');
                Route::get('/edit/content/{content}', 'ContentController@edit');
                Route::get('/edit/content/{content}/material', 'ContentController@getMaterial');
                Route::put('/edit/content/{content}', 'ContentController@update');
                Route::delete('/edit/content/delete/{content}', 'ContentController@destroy');
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

Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login');

Route::prefix('/teacher')
    ->middleware('auth:teacher')
    ->name('teacher.')
    ->namespace('Teacher')
    ->group(function(){
        Route::get('/', 'TeacherDashboard@teacher')->name('home');
        Route::get('/profile', 'TeacherDashboard@profile')->name('profile');
        Route::get('/profile/info', 'TeacherDashboard@info')->name('info');
        Route::get('/course/{course}/activity', 'TeacherDashboard@activity')->name('activity');
        Route::get('/course/{course}/content', 'TeacherDashboard@content')->name('content');
        Route::get('/course/{course}', 'TeacherDashboard@courseInfo')->name('course');
        Route::get('/courses', 'TeacherDashboard@courses')->name('courses');
        Route::get('/courses/list', 'TeacherDashboard@list');

        Route::prefix('/course')
            ->name('course.')
            ->group(function(){
                Route::get('/{course}/activity/add', 'TeacherDashboard@createActivity')->name('createActivity');
                Route::post('/{course}/activity/add', 'TeacherDashboard@storeActivity');
                Route::get('/activity/{activity}', 'TeacherDashboard@activityDetail')->name('activityMaterial');
                Route::get('/content/{content}', 'TeacherDashboard@contentDetail')->name('contentMaterial');
                Route::get('/activity/{activity}/json', 'TeacherDashboard@activityJson');
                Route::get('/content/{content}/json', 'TeacherDashboard@contentJson');
            });
    });


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/info', 'HomeController@info')->name('info');

Route::prefix('/course')
    ->name('course.')
    ->group(function(){
        Route::get('/{course}/activity/add', 'HomeController@createActivity')->name('createActivity');
        Route::post('/{course}/activity/add', 'HomeController@storeActivity');
        Route::get('/{course}/activity', 'HomeController@activity')->name('activity');
        Route::get('/{course}/content', 'HomeController@content')->name('content');
        Route::get('/{course}', 'HomeController@courseInfo')->name('course');
        Route::get('/activity/{activity}', 'HomeController@activityDetail')->name('activityMaterial');
        Route::get('/content/{content}', 'HomeController@contentDetail')->name('contentMaterial');
        Route::get('/activity/{activity}/json', 'HomeController@activityJson');
        Route::get('/content/{content}/json', 'HomeController@contentJson');
    });

Route::prefix('/courses')
    ->group(function(){
        Route::get('/', 'HomeController@courses')->name('courses');
        Route::get('/list', 'HomeController@list');
    });

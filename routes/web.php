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
                Route::get('/register', 'UserController@create')->name('register');
                Route::post('/register', 'UserController@store');
                Route::get('/edit/{user}', 'UserController@show')->name('edit');
                Route::put('/edit/{user}', 'UserController@update');
                Route::post('/edit/{user}/associate', 'UserController@associate');
                Route::get('/courses/{user}', 'UserController@courses');
                Route::put('/courses/{user}/detach', 'UserController@detach');
                Route::delete('/delete/{user}', 'UserController@destroy');
            });

        Route::prefix('/payment')
            ->name('payment.')
            ->group(function(){
                Route::get('/', 'PaymentController@index')->name('list');
                Route::get('/list', 'PaymentController@list');
                Route::get('/list/{user}', 'PaymentController@show')->name('show');
                Route::get('/list/{user}/bills', 'PaymentController@payments')->name('show');
                Route::put('/suspend/{user}', 'PaymentController@suspend');

                Route::get('/register', 'PaymentController@create')->name('register');
                Route::post('/register', 'PaymentController@store');

//                Route::put('/courses/{user}/detach', 'PaymentController@detach');
//                Route::post('/edit/{user}/associate', 'PaymentController@associate');

                Route::put('/paid/{payment}', 'PaymentController@update');
                Route::delete('/delete/{payment}', 'PaymentController@destroy');
            });

        Route::prefix('/services')
            ->name('services.')
            ->group(function(){
                Route::get('/', 'AdminDashboard@services')->name('dashboard');
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
                Route::get('/edit/{course}/students', 'CourseController@students')->name('students');
                Route::delete('/delete/{course}', 'CourseController@destroy');

                Route::get('/edit/{course}/module', 'ModuleController@show');
                Route::get('/edit/{course}/module/add', 'ModuleController@create')->name('module');
                Route::post('/edit/{course}/module/add', 'ModuleController@store');
                Route::get('/edit/module/{module}', 'ModuleController@edit');
                Route::get('/edit/module/{module}/json', 'ModuleController@moduleJson');
                Route::get('/edit/module/{module}/material', 'ModuleController@getMaterial');
                Route::put('/edit/module/{module}', 'ModuleController@update');
                Route::delete('/edit/module/delete/{module}', 'ModuleController@destroy');

                Route::get('/edit/module/{module}/activity', 'ActivityController@show');
                Route::get('/edit/{module}/activity/add', 'ActivityController@create')->name('activity');
                Route::post('/edit/{module}/activity/add', 'ActivityController@store');
                Route::get('/edit/module/activity/{activity}', 'ActivityController@edit');
                Route::put('/edit/module/activity/{activity}', 'ActivityController@update');
                Route::get('/edit/module/activity/{activity}/json', 'ActivityController@getJson');
                Route::get('/edit/module/activity/{activity}/material', 'ActivityController@getMaterial');
                Route::get('/edit/module/activity/{activity}/homework', 'ActivityController@homework')->name('homework');
                Route::delete('/edit/module/activity/delete/{activity}', 'ActivityController@destroy');

                Route::get('/edit/module/{module}/content', 'ContentController@show');
                Route::get('/edit/{module}/content/add', 'ContentController@create')->name('content');
                Route::post('/edit/{module}/content/add', 'ContentController@store');
                Route::get('/edit/module/content/{content}', 'ContentController@edit');
                Route::get('/edit/module/content/{content}/json', 'ContentController@getJson');
                Route::get('/edit/module/content/{content}/material', 'ContentController@getMaterial');
                Route::put('/edit/module/content/{content}', 'ContentController@update');
                Route::delete('/edit/module/content/delete/{content}', 'ContentController@destroy');
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

        Route::prefix('/exam')
            ->name('exam.')
            ->group(function(){
                Route::get('/', 'ExamController@index')->name('list');
                Route::get('/list', 'ExamController@list');
                Route::get('/register', 'ExamController@create')->name('register');
                Route::post('/register', 'ExamController@store');
                Route::get('/edit/{exam}', 'ExamController@show')->name('edit');
                Route::get('/edit/{exam}/json', 'ExamController@showJson');
                Route::put('/edit/{exam}', 'ExamController@update');
                Route::delete('/delete/{exam}', 'ExamController@destroy');
            });

        Route::prefix('/question')
            ->name('question.')
            ->group(function(){
                Route::get('{exam}/list', 'QuestionController@index');
                Route::post('/register', 'QuestionController@store');
                Route::put('/edit/{question}', 'QuestionController@update');
                Route::delete('/delete/{question}', 'QuestionController@destroy');
            });

        Route::prefix('/answer')
            ->name('answer.')
            ->group(function(){
                Route::get('{question}/list', 'AnswerController@index');
                Route::post('/register', 'AnswerController@store');
                Route::put('/edit/{answer}', 'AnswerController@update');
                Route::delete('/delete/{answer}', 'AnswerController@destroy');
            });
});

Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login');

Route::prefix('/teacher')
    ->middleware('auth:teacher')
    ->name('teacher.')
    ->namespace('Teacher')
    ->group(function(){
        Route::get('/', 'TeacherDashboard@teacher')->name('dashboard');
        Route::get('/profile', 'TeacherDashboard@profile')->name('profile');
        Route::get('/profile/info', 'TeacherDashboard@info')->name('info');
        Route::get('/courses', 'TeacherDashboard@courses')->name('courses');

        Route::prefix('/course')
            ->name('course.')
            ->group(function(){
                Route::get('/list', 'TeacherDashboard@list');

                Route::get('/{course}/exam', 'ExamController@exam')->name('examList');
                Route::get('/{course}', 'TeacherDashboard@courseInfo')->name('course');
                Route::get('/{course}/module', 'TeacherDashboard@module')->name('module');
                Route::get('/{course}/students', 'StudentController@index')->name('students');
                Route::get('/{course}/student/{student}', 'StudentController@student')->name('students');
                Route::post('/{course}/student/{student}/result', 'StudentController@result')->name('students');
                Route::get('/edit/{course}/module', 'TeacherDashboard@module')->name('module');
                Route::get('/module/{module}/activity', 'TeacherDashboard@activity')->name('activity');
                Route::get('/module/{module}/content', 'TeacherDashboard@content')->name('content');

                Route::get('/exam/{exam}', 'ExamController@gradeExam')->name('gradeExam');
                Route::get('/exam/{exam}/grade', 'ExamController@getGradesExam')->name('getGradesExam');
                Route::get('/exam/grade/{score}', 'ExamController@getScores')->name('getScores');
                Route::get('/exam/grade/{score}/json', 'ExamController@getScoresJson')->name('getScoresJson');
                Route::post('/exam/grade/{score}/finish', 'ExamController@finishScores')->name('finishScores');
                Route::get('/{course}/activity/add', 'TeacherDashboard@createActivity')->name('createActivity');
                Route::post('/{course}/activity/add', 'TeacherDashboard@storeActivity');

                Route::prefix('/module')
                    ->name('module.')
                    ->group(function(){
                        Route::get('/{module}', 'TeacherDashboard@moduleDetail')->name('moduleMaterial');
                        Route::get('/{module}/json', 'TeacherDashboard@moduleJson');
                        Route::get('/{module}/exam', 'ExamController@examModule')->name('examModuleList');
                        Route::get('/exam/{exam}', 'ExamController@gradeExam')->name('gradeExam');
                        Route::get('/exam/{exam}/grade', 'ExamController@getGradesExam')->name('getGradesExam');
                        Route::get('/exam/grade/{score}', 'ExamController@getScores')->name('getScores');
                        Route::get('/exam/grade/{score}/json', 'ExamController@getScoresJson')->name('getScoresJson');
                        Route::post('/exam/grade/{score}/finish', 'ExamController@finishScores')->name('finishScores');
                        Route::get('/activity/{activity}', 'TeacherDashboard@activityDetail')->name('activityMaterial');
                        Route::get('/activity/{activity}/json', 'TeacherDashboard@activityJson');
                        Route::get('/activity/{activity}/score', 'TeacherDashboard@score');
                        Route::put('/activity/{activity}/score', 'TeacherDashboard@scoreSave');
                        Route::get('/activity/{activity}/homework', 'TeacherDashboard@homework')->name('homework');
                        Route::get('/activity/homework/{homework}', 'TeacherDashboard@homeworkDetail')->name('homeworkDetail');
                        Route::get('/activity/homework/{homework}/json', 'TeacherDashboard@homeworkJson')->name('homeworkJson');
                        Route::get('/activity/homework/{homework}/score', 'TeacherDashboard@homeworkScore')->name('homeworkScore');
                        Route::put('/activity/homework/{homework}/score', 'TeacherDashboard@homeworkScoreSave')->name('homeworkScoreSave');
                        Route::get('/content/{content}', 'TeacherDashboard@contentDetail')->name('contentMaterial');
                        Route::get('/content/{content}/json', 'TeacherDashboard@contentJson');
                    });
            });

        Route::prefix('/exam')
            ->name('exam.')
            ->group(function(){
                Route::get('/', 'ExamController@index')->name('list');
                Route::get('/list', 'ExamController@list');
                Route::get('/register', 'ExamController@create')->name('register');
                Route::post('/register', 'ExamController@store');
                Route::get('/edit/{exam}', 'ExamController@show')->name('edit');
                Route::get('/edit/{exam}/json', 'ExamController@showJson');
                Route::put('/edit/{exam}', 'ExamController@update');
                Route::delete('/delete/{exam}', 'ExamController@destroy');
            });

        Route::prefix('/question')
            ->name('question.')
            ->group(function(){
                Route::get('{exam}/list', 'QuestionController@index');
                Route::post('/register', 'QuestionController@store');
                Route::put('/edit/{question}', 'QuestionController@update');
                Route::delete('/delete/{question}', 'QuestionController@destroy');
            });

        Route::prefix('/answer')
            ->name('answer.')
            ->group(function(){
                Route::get('{question}/list', 'AnswerController@index');
                Route::post('/register', 'AnswerController@store');
                Route::put('/edit/{answer}', 'AnswerController@update');
                Route::delete('/delete/{answer}', 'AnswerController@destroy');
            });
    });


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/info', 'HomeController@info')->name('info');

Route::prefix('/course')
    ->name('course.')
    ->group(function(){
        Route::get('/{course}', 'HomeController@courseInfo')->name('course');
        Route::get('/{course}/exam', 'ExamController@exam')->name('exam');
        Route::get('/{course}/module', 'HomeController@module')->name('module');
        Route::get('/{course}/students', 'HomeController@students')->name('module');

        Route::prefix('/module')
            ->name('module.')
            ->group(function(){
                Route::get('/{module}/activity', 'HomeController@activity')->name('activity');
                Route::get('/{module}/content', 'HomeController@content')->name('content');
                Route::get('/{module}/exam', 'ExamController@examModule')->name('examModule');
                Route::get('/{module}', 'HomeController@moduleDetail')->name('moduleMaterial');
                Route::get('/{module}/json', 'HomeController@moduleJson');

                Route::get('/activity/{activity}/homework', 'HomeController@createHomework')->name('createHomework');
                Route::post('/activity/{activity}/homework', 'HomeController@storeHomework');

                Route::get('/activity/{activity}', 'HomeController@activityDetail')->name('activityMaterial');
                Route::get('/content/{content}', 'HomeController@contentDetail')->name('contentMaterial');
                Route::get('/activity/{activity}/json', 'HomeController@activityJson');
                Route::get('/content/{content}/json', 'HomeController@contentJson');

                Route::prefix('/exam')
                    ->name('exam.')
                    ->group(function(){
                        Route::get('/{exam}', 'ExamController@solve')->name('solve');
                        Route::get('/{exam}/start', 'ExamController@start')->name('start');
                        Route::get('/{exam}/grade', 'ExamController@grade')->name('grade');
                        Route::post('/{exam}/finish', 'ExamController@finish')->name('finish');
                        Route::post('/{question}/claim', 'ExamController@saveClaim')->name('saveClaim');
                        Route::get('/{question}/claim', 'ExamController@loadClaim')->name('loadClaim');
                    });
            });

    });

Route::prefix('/courses')
    ->group(function(){
        Route::get('/', 'HomeController@courses')->name('courses');
        Route::get('/list', 'HomeController@list');
    });

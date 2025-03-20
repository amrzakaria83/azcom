<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Teacher\HomeController;

Auth::routes();

Route::get('/lang-change', [HomeController::class ,'changLang'])->name('teacher.lang.change');
Route::get('/login', [AdminLoginController::class ,'showAdminLoginForm'])->name('teacher.login');
Route::post('/login', [AdminLoginController::class ,'adminLogin'])->name('teacher.login.submit');
Route::get('/logout', [AdminLoginController::class ,'logout'])->name('teacher.logout');

Route::name('teacher.')->middleware(['auth:teacher'])->group(function () {
    
    Route::middleware(['emp-access:teacher'])->group(function () {

        Route::get('/','HomeController@index')->name('index');

        Route::name('employees.')->prefix('employees')->group(function(){
            Route::get('/show/{id}','EmployeesController@show')->name('show');
        });

        Route::name('users.')->prefix('users')->group(function(){
            Route::get('/','UsersController@index')->name('index');
            Route::get('/show/{id}','UsersController@show')->name('show');
            Route::post('/delete', 'UsersController@destroy')->name('delete');
            Route::get('/create','UsersController@create')->name('create');
            Route::post('/store','UsersController@store')->name('store');
            Route::get('/edit/{id}', 'UsersController@edit')->name('edit');
            Route::post('/update', 'UsersController@update')->name('update');
        });

        Route::name('levels.')->prefix('levels')->group(function(){
            Route::get('/','LevelsController@index')->name('index');
            Route::post('/delete', 'LevelsController@destroy')->name('delete');
            Route::post('/store','LevelsController@store')->name('store');
            Route::get('/edit/{id}', 'LevelsController@edit')->name('edit');
            Route::post('/update', 'LevelsController@update')->name('update');
        });

        Route::name('subjects.')->prefix('subjects')->group(function(){
            Route::get('/','SubjectsController@index')->name('index');
            Route::post('/delete', 'SubjectsController@destroy')->name('delete');
            Route::post('/store','SubjectsController@store')->name('store');
            Route::get('/edit/{id}', 'SubjectsController@edit')->name('edit');
            Route::post('/update', 'SubjectsController@update')->name('update');
        });

        Route::name('classrooms.')->prefix('classrooms')->group(function(){
            Route::get('/','ClassroomsController@index')->name('index');
            Route::get('/show/{id}','ClassroomsController@show')->name('show');
            Route::post('/delete', 'ClassroomsController@destroy')->name('delete');
            Route::post('/store','ClassroomsController@store')->name('store');
            Route::get('/edit/{id}', 'ClassroomsController@edit')->name('edit');
            Route::post('/update', 'ClassroomsController@update')->name('update');
        });

        Route::name('classroomstudents.')->prefix('classroomstudents')->group(function(){
            Route::get('/','ClassroomStudentsController@index')->name('index');
            Route::post('/delete', 'ClassroomStudentsController@destroy')->name('delete');
            Route::get('/create/{classroom_id}','ClassroomStudentsController@create')->name('create');
            Route::post('/store','ClassroomStudentsController@store')->name('store');
        });

        Route::name('classroomteachers.')->prefix('classroomteachers')->group(function(){
            Route::get('/','ClassroomEmployeesController@index')->name('index');
            Route::post('/delete', 'ClassroomEmployeesController@destroy')->name('delete');
            Route::post('/store','ClassroomEmployeesController@store')->name('store');
        });

        Route::name('classroomsubjects.')->prefix('classroomsubjects')->group(function(){
            Route::get('/','ClassroomSubjectsController@index')->name('index');
            Route::get('/show/{id}','ClassroomSubjectsController@getSubjectByClass')->name('show');
            Route::post('/delete', 'ClassroomSubjectsController@destroy')->name('delete');
            Route::post('/store','ClassroomSubjectsController@store')->name('store');
        });

        Route::name('classroomschedules.')->prefix('classroomschedules')->group(function(){
            Route::get('/','ClassroomSchedulesController@index')->name('index');
            Route::post('/delete', 'ClassroomSchedulesController@destroy')->name('delete');
            Route::post('/store','ClassroomSchedulesController@store')->name('store');
        });

        Route::name('dailyreports.')->prefix('dailyreports')->group(function(){
            Route::get('/','ClassroomDailyReportController@index')->name('index');
            Route::post('/delete', 'ClassroomDailyReportController@destroy')->name('delete');
            Route::post('/store','ClassroomDailyReportController@store')->name('store');
        });

        Route::name('absences.')->prefix('absences')->group(function(){
            Route::get('/','ClassroomAbsenceController@index')->name('index');
            Route::post('/delete', 'ClassroomAbsenceController@destroy')->name('delete');
            Route::post('/store','ClassroomAbsenceController@store')->name('store');
        });

        Route::name('students.')->prefix('students')->group(function(){
            Route::get('/','StudentsController@index')->name('index');
            Route::get('/show/{id}','StudentsController@show')->name('show');
            Route::post('/delete', 'StudentsController@destroy')->name('delete');
            Route::get('/create','StudentsController@create')->name('create');
            Route::post('/store','StudentsController@store')->name('store');
            Route::get('/edit/{id}', 'StudentsController@edit')->name('edit');
            Route::post('/update', 'StudentsController@update')->name('update');
        });

        Route::name('pages.')->prefix('pages')->group(function(){
            Route::get('/','PagesController@index')->name('index');
            Route::get('/show/{id}','PagesController@show')->name('show');
            Route::post('/delete', 'PagesController@destroy')->name('delete');
            Route::get('/create','PagesController@create')->name('create');
            Route::post('/store','PagesController@store')->name('store');
            Route::get('/edit/{id}', 'PagesController@edit')->name('edit');
            Route::post('/update', 'PagesController@update')->name('update');
        });

        Route::name('wallas.')->prefix('wallas')->group(function(){
            Route::get('/','WallasController@index')->name('index');
            Route::get('/show/{id}','WallasController@show')->name('show');
            Route::post('/delete', 'WallasController@destroy')->name('delete');
            Route::get('/create','WallasController@create')->name('create');
            Route::post('/store','WallasController@store')->name('store');
            Route::get('/edit/{id}', 'WallasController@edit')->name('edit');
            Route::post('/update', 'WallasController@update')->name('update');
        });

        Route::name('notifications.')->prefix('notifications')->group(function(){
            Route::get('/','NotificationController@index')->name('index');
            Route::get('/show/{id}','NotificationController@show')->name('show');
            Route::post('/delete', 'NotificationController@destroy')->name('delete');
            Route::get('/create','NotificationController@create')->name('create');
            Route::post('/store','NotificationController@store')->name('store');
            Route::get('/edit/{id}', 'NotificationController@edit')->name('edit');
            Route::post('/update', 'NotificationController@update')->name('update');
        });

        Route::name('scratchvideos.')->prefix('scratchvideos')->group(function(){
            Route::get('/','ScratchVideoController@index')->name('index');
            Route::get('/show/{id}','ScratchVideoController@show')->name('show');
            Route::post('/delete', 'ScratchVideoController@destroy')->name('delete');
            Route::get('/create','ScratchVideoController@create')->name('create');
            Route::post('/store','ScratchVideoController@store')->name('store');
            Route::get('/edit/{id}', 'ScratchVideoController@edit')->name('edit');
            Route::post('/update', 'ScratchVideoController@update')->name('update');
            Route::post('/change_active', 'ScratchVideoController@changeActive')->name('change_active');
        });

        Route::name('messages.')->prefix('messages')->group(function(){
            Route::get('/getmsg/{student_id}/{teacher_id}','MessageController@getMsg')->name('index');
            Route::get('/getmsgdetails/{student_id}/{teacher_id}','MessageController@getMsgDetails')->name('getmsgdetails');
            Route::post('/delete', 'MessageController@destroy')->name('delete');
            Route::post('/store','MessageController@store')->name('store');
        });

        Route::name('sections.')->prefix('sections')->group(function(){
            Route::get('/','SectionsController@index')->name('index');
            Route::get('/show/{id}','SectionsController@show')->name('show');
            Route::post('/delete', 'SectionsController@destroy')->name('delete');
            Route::post('/store','SectionsController@store')->name('store');
            Route::get('/edit/{id}', 'SectionsController@edit')->name('edit');
            Route::post('/update', 'SectionsController@update')->name('update');
        });

        Route::name('questions.')->prefix('questions')->group(function(){
            Route::get('/','QuestionsController@index')->name('index');
            Route::get('/show/{id}','QuestionsController@show')->name('show');
            Route::post('/delete', 'QuestionsController@destroy')->name('delete');
            Route::get('/create','QuestionsController@create')->name('create');
            Route::post('/store','QuestionsController@store')->name('store');
            Route::get('/edit/{id}', 'QuestionsController@edit')->name('edit');
            Route::post('/update', 'QuestionsController@update')->name('update');
        });

        Route::name('exams.')->prefix('exams')->group(function(){
            Route::get('/','ExamsController@index')->name('index');
            Route::get('/show/{id}','ExamsController@show')->name('show');
            Route::post('/delete', 'ExamsController@destroy')->name('delete');
            Route::get('/create','ExamsController@create')->name('create');
            Route::post('/store','ExamsController@store')->name('store');
            Route::get('/edit/{id}', 'ExamsController@edit')->name('edit');
            Route::post('/update', 'ExamsController@update')->name('update');
            Route::get('/examquestion','ExamsController@examquestion')->name('examquestion');
            Route::get('/deleteque/{id}','ExamsController@deleteque')->name('deleteque');
            Route::get('/allquestion','ExamsController@allquestion')->name('allquestion');
            Route::post('/addque', 'ExamsController@addque')->name('addque');
            Route::get('/studentexam', 'ExamsController@studentexam')->name('studentexam');
            Route::get('/exam-show/{id}','ExamsController@studentexamshow')->name('studentexamshow');
            Route::get('/results/{id}','ExamsController@Results')->name('results');
            Route::get('/deleteresult/{id}','ExamsController@deleteresult')->name('deleteresult');
        });

    });
    
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;

Auth::routes();

Route::get('/lang-change', [HomeController::class ,'changLang'])->name('admin.lang.change');
Route::get('/login', [AdminLoginController::class ,'showAdminLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class ,'adminLogin'])->name('admin.login.submit');
Route::get('/logout', [AdminLoginController::class ,'logout'])->name('admin.logout');

Route::name('admin.')->middleware(['auth:admin'])->group(function () {
    
    Route::middleware(['emp-access:0'])->group(function () {

        Route::get('/','HomeController@index')->name('index');

        Route::name('settings.')->prefix('settings')->group(function(){
            Route::get('/edit/{id}', 'SettingsController@edit')->name('edit');
            Route::post('/update', 'SettingsController@update')->name('update');
        }); 

        Route::name('employees.')->prefix('employees')->group(function(){
            Route::get('/','EmployeesController@index')->name('index');
            Route::get('/show/{id}','EmployeesController@show')->name('show')->can('employee details');
            Route::post('/delete', 'EmployeesController@destroy')->name('delete');
            Route::get('/create','EmployeesController@create')->name('create');
            Route::post('/store','EmployeesController@store')->name('store');
            Route::get('/edit/{id}', 'EmployeesController@edit')->name('edit')->can('employee edit');
            Route::post('/update', 'EmployeesController@update')->name('update');
            Route::get('/createhierarchy/{id?}','EmployeesController@createhierarchy')->name('createhierarchy');
            Route::post('/storehierarchy','EmployeesController@storehierarchy')->name('storehierarchy');
            Route::get('/editehierarchy/{id}', 'EmployeesController@editehierarchy')->name('editehierarchy');
        });

        Route::name('roles.')->prefix('roles')->group(function(){
            Route::get('/','RolesController@index')->name('index');
            Route::post('/delete', 'RolesController@destroy')->name('delete')->can('role delete');
            Route::get('/create','RolesController@create')->name('create')->can('role new');
            Route::post('/store','RolesController@store')->name('store');
            Route::get('/edit/{id}', 'RolesController@edit')->name('edit')->can('role edit');
            Route::post('/update', 'RolesController@update')->name('update');
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

        Route::name('degrees.')->prefix('degrees')->group(function(){
            Route::get('/','DegreesController@index')->name('index');
            Route::post('/delete', 'DegreesController@destroy')->name('delete');
            Route::get('/create/{classroom_id}','DegreesController@create')->name('create');
            Route::post('/store','DegreesController@store')->name('store');
            Route::get('/edit/{id}', 'DegreesController@edit')->name('edit');
            Route::post('/update', 'DegreesController@update')->name('update');
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

        Route::name('blogs.')->prefix('blogs')->group(function(){
            Route::get('/','BlogsController@index')->name('index');
            Route::get('/show/{id}','BlogsController@show')->name('show');
            Route::post('/delete', 'BlogsController@destroy')->name('delete');
            Route::get('/create','BlogsController@create')->name('create');
            Route::post('/store','BlogsController@store')->name('store');
            Route::get('/edit/{id}', 'BlogsController@edit')->name('edit');
            Route::post('/update', 'BlogsController@update')->name('update');
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
        Route::name('account_trees.')->prefix('account_trees')->group(function(){
            Route::get('/','Account_treesController@index')->name('index');
            Route::get('/indexaccount','Account_treesController@indexaccount')->name('indexaccount');
            Route::get('/normalaccounttree','Account_treesController@normalaccounttree')->name('normalaccounttree');
            Route::get('/show/{id}','Account_treesController@show')->name('show');
            Route::post('/delete', 'Account_treesController@destroy')->name('delete');
            Route::get('/create','Account_treesController@create')->name('create');
            Route::post('/store','Account_treesController@store')->name('store');
            Route::get('/edit/{id}', 'Account_treesController@edit')->name('edit');
            Route::post('/update', 'Account_treesController@update')->name('update');
        });
        Route::name('way_sells.')->prefix('way_sells')->group(function(){
            Route::get('/','WaysellsController@index')->name('index');
            Route::get('/show/{id}','WaysellsController@show')->name('show');
            Route::post('/delete', 'WaysellsController@destroy')->name('delete');
            Route::get('/create','WaysellsController@create')->name('create');
            Route::post('/store','WaysellsController@store')->name('store');
            Route::post('/storemodel','WaysellsController@storemodel')->name('storemodel');
            Route::get('/edit/{id}', 'WaysellsController@edit')->name('edit');
            Route::post('/update', 'WaysellsController@update')->name('update');
        });
        Route::name('cashiers.')->prefix('cashiers')->group(function(){
            Route::get('/','CashiersController@index')->name('index');
            Route::get('/show/{id}','CashiersController@show')->name('show');
            Route::post('/delete', 'CashiersController@destroy')->name('delete');
            Route::get('/create','CashiersController@create')->name('create');
            Route::post('/store','CashiersController@store')->name('store');
            Route::get('/edit/{id}', 'CashiersController@edit')->name('edit');
            Route::post('/update', 'CashiersController@update')->name('update');
            Route::get('/createsession','CashiersController@createsession')->name('createsession');
            Route::post('/storesession','CashiersController@storesession')->name('storesession');
        });
        Route::name('vacationemps.')->prefix('vacationemps')->group(function(){
            Route::get('/','VacationempsController@index')->name('index');
            Route::get('/indexall','VacationempsController@indexall')->name('indexall');
            Route::get('/show/{id}','VacationempsController@show')->name('show');
            Route::post('/delete', 'VacationempsController@destroy')->name('delete');
            Route::get('/create','VacationempsController@create')->name('create');
            Route::post('/store','VacationempsController@store')->name('store');
            Route::get('/edit/{id}', 'VacationempsController@edit')->name('edit')->can('vacation edit');
            Route::post('/update', 'VacationempsController@update')->name('update');
            
        });
        Route::name('expense_requests.')->prefix('expense_requests')->group(function(){
            Route::get('/','Expense_requestsController@index')->name('index');
            Route::get('/show/{id}','Expense_requestsController@show')->name('show');
            Route::post('/delete', 'Expense_requestsController@destroy')->name('delete');
            Route::get('/create','Expense_requestsController@create')->name('create');
            Route::post('/store','Expense_requestsController@store')->name('store');
            Route::get('/edit/{id}', 'Expense_requestsController@edit')->name('edit');
            Route::post('/update', 'Expense_requestsController@update')->name('update');
            Route::post('/storetype','Expense_requestsController@storetype')->name('storetype');
            
        });

        Route::name('centers.')->prefix('centers')->group(function(){
            Route::get('/','CentersController@index')->name('index');
            Route::get('/show/{id}','CentersController@show')->name('show')->can('center details');
            Route::post('/delete', 'CentersController@destroy')->name('delete');
            Route::get('/create','CentersController@create')->name('create');
            Route::post('/store','CentersController@store')->name('store');
            Route::get('/edit/{id}', 'CentersController@edit')->name('edit')->can('center edit');
            Route::post('/update', 'CentersController@update')->name('update');
            Route::post('/storetype','CentersController@storetype')->name('storetype');
            Route::post('/storeworkhour','CentersController@storeworkhour')->name('storeworkhour');
            Route::get('/showlocation','CentersController@showlocation')->name('showlocation');

            
        });

        Route::name('working_hours.')->prefix('working_hours')->group(function(){
            Route::get('/','Working_hoursController@index')->name('index');
            Route::get('/show/{id}','Working_hoursController@show')->name('show');
            Route::post('/delete', 'Working_hoursController@destroy')->name('delete');
            Route::get('/create','Working_hoursController@create')->name('create');
            Route::post('/store','Working_hoursController@store')->name('store');
            Route::get('/edit/{id}', 'Working_hoursController@edit')->name('edit');
            Route::post('/update', 'Working_hoursController@update')->name('update');
            Route::post('/storetype','Working_hoursController@storetype')->name('storetype');
            
        });

        Route::name('assistants.')->prefix('assistants')->group(function(){
            Route::get('/','AssistantsController@index')->name('index');
            Route::get('/show/{id}','AssistantsController@show')->name('show')->can('assistant details');
            Route::post('/delete', 'AssistantsController@destroy')->name('delete');
            Route::get('/create','AssistantsController@create')->name('create');
            Route::post('/store','AssistantsController@store')->name('store');
            Route::get('/edit/{id}', 'AssistantsController@edit')->name('edit')->can('assistant edit');
            Route::post('/update', 'AssistantsController@update')->name('update');
            Route::post('/storeworkhour','AssistantsController@storeworkhour')->name('storeworkhour');

        });

        Route::name('products.')->prefix('products')->group(function(){
            Route::get('/','ProductsController@index')->name('index');
            Route::get('/show/{id}','ProductsController@show')->name('show')->can('product details');
            Route::post('/delete', 'ProductsController@destroy')->name('delete');
            Route::get('/create','ProductsController@create')->name('create');
            Route::post('/store','ProductsController@store')->name('store');
            Route::get('/edit/{id}', 'ProductsController@edit')->name('edit')->can('product edit');
            Route::post('/update', 'ProductsController@update')->name('update');

        });

        Route::name('cycle_msg_prods.')->prefix('cycle_msg_prods')->group(function(){
            Route::get('/','Cycle_msg_prodsController@index')->name('index');
            Route::get('/show/{id}','Cycle_msg_prodsController@show')->name('show')->can('product msg details');
            Route::post('/delete', 'Cycle_msg_prodsController@destroy')->name('delete');
            Route::get('/create','Cycle_msg_prodsController@create')->name('create');
            Route::post('/store','Cycle_msg_prodsController@store')->name('store');
            Route::get('/edit/{id}', 'Cycle_msg_prodsController@edit')->name('edit')->can('product msg edit');
            Route::post('/update', 'Cycle_msg_prodsController@update')->name('update');

        });

        Route::name('areas.')->prefix('areas')->group(function(){
            Route::get('/','AreasController@index')->name('index');
            Route::get('/show/{id}','AreasController@show')->name('show')->can('area details');
            Route::post('/delete', 'AreasController@destroy')->name('delete');
            Route::get('/create','AreasController@create')->name('create');
            Route::post('/store','AreasController@store')->name('store');
            Route::get('/edit/{id}', 'AreasController@edit')->name('edit')->can('area edit');
            Route::post('/update', 'AreasController@update')->name('update');
            Route::get('/getGovernorate','AreasController@getGovernorate')->name('getGovernorate');
            Route::get('/getCitiesByGovernorate','AreasController@getCitiesByGovernorate')->name('getCitiesByGovernorate');
            Route::get('/getemrate','AreasController@getemrate')->name('getemrate');

        });

        Route::name('specialtys.')->prefix('specialtys')->group(function(){
            Route::get('/','SpecialtysController@index')->name('index');
            Route::get('/show/{id}','SpecialtysController@show')->name('show')->can('specialty details');
            Route::post('/delete', 'SpecialtysController@destroy')->name('delete');
            Route::get('/create','SpecialtysController@create')->name('create');
            Route::post('/store','SpecialtysController@store')->name('store');
            Route::get('/edit/{id}', 'SpecialtysController@edit')->name('edit')->can('specialty edit');
            Route::post('/update', 'SpecialtysController@update')->name('update');
            
        });

        Route::name('brand_gifts.')->prefix('brand_gifts')->group(function(){
            Route::get('/','Brand_giftsController@index')->name('index');
            Route::get('/show/{id}','Brand_giftsController@show')->name('show')->can('brand gift details');
            Route::post('/delete', 'Brand_giftsController@destroy')->name('delete');
            Route::get('/create','Brand_giftsController@create')->name('create');
            Route::post('/store','Brand_giftsController@store')->name('store');
            Route::get('/edit/{id}', 'Brand_giftsController@edit')->name('edit')->can('brand gift edit');
            Route::post('/update', 'Brand_giftsController@update')->name('update');

        });

        Route::name('social_styls.')->prefix('social_styls')->group(function(){
            Route::get('/','Social_stylsController@index')->name('index');
            Route::get('/show/{id}','Social_stylsController@show')->name('show')->can('social style details');
            Route::post('/delete', 'Social_stylsController@destroy')->name('delete');
            Route::get('/create','Social_stylsController@create')->name('create');
            Route::post('/store','Social_stylsController@store')->name('store');
            Route::get('/edit/{id}', 'Social_stylsController@edit')->name('edit')->can('social style edit');
            Route::post('/update', 'Social_stylsController@update')->name('update');

        });

        Route::name('cut_sales.')->prefix('cut_sales')->group(function(){
            Route::get('/','Cut_salesController@index')->name('index'); // can
            Route::get('/show/{id}','Cut_salesController@show')->name('show'); // can
            Route::post('/delete', 'Cut_salesController@destroy')->name('delete'); // can
            Route::get('/create','Cut_salesController@create')->name('create'); // can
            Route::post('/store','Cut_salesController@store')->name('store'); // can
            Route::get('/edit/{id}', 'Cut_salesController@edit')->name('edit'); // can
            Route::post('/update', 'Cut_salesController@update')->name('update'); // can

        });

        Route::name('contract_drs.')->prefix('contract_drs')->group(function(){
            Route::get('/','Contract_drsController@index')->name('index');
            Route::get('/show/{id}','Contract_drsController@show')->name('show');
            Route::post('/delete', 'Contract_drsController@destroy')->name('delete');
            Route::get('/create','Contract_drsController@create')->name('create');
            Route::post('/store','Contract_drsController@store')->name('store');
            Route::get('/edit/{id}', 'Contract_drsController@edit')->name('edit');
            Route::post('/update', 'Contract_drsController@update')->name('update');

        });

        Route::name('contacts.')->prefix('contacts')->group(function(){
            Route::get('/','ContactsController@index')->name('index');
            Route::get('/indextotal','ContactsController@indextotal')->name('indextotal');
            Route::get('/show/{id}','ContactsController@show')->name('show')->can('contact details');
            Route::post('/delete', 'ContactsController@destroy')->name('delete');
            Route::get('/create','ContactsController@create')->name('create');
            Route::post('/store','ContactsController@store')->name('store');
            Route::get('/edit/{id}', 'ContactsController@edit')->name('edit')->can('contact edit');
            Route::post('/update', 'ContactsController@update')->name('update');
            Route::get('/add_contact_rate','ContactsController@add_contact_rate')->name('add_contact_rate');
            Route::post('/storecontact_rate','ContactsController@storecontact_rate')->name('storecontact_rate');
            Route::get('/indextotalserch/{list?}','ContactsController@indextotalserch')->name('indextotalserch');


        });

        Route::name('ratings.')->prefix('ratings')->group(function(){
            Route::get('/','RatingsController@index')->name('index');
            Route::get('/show/{id}','RatingsController@show')->name('show')->can('rating details');
            Route::post('/delete', 'RatingsController@destroy')->name('delete');
            Route::get('/create','RatingsController@create')->name('create');
            Route::post('/store','RatingsController@store')->name('store');
            Route::get('/edit/{id}', 'RatingsController@edit')->name('edit')->can('rating edit');
            Route::post('/update', 'RatingsController@update')->name('update');

        });

        Route::name('ratingcontacts.')->prefix('ratingcontacts')->group(function(){
            Route::get('/','Contact_ratesController@index')->name('index');
            Route::get('/show/{id}','Contact_ratesController@show')->name('show');
            Route::post('/delete', 'Contact_ratesController@destroy')->name('delete');
            Route::get('/create','Contact_ratesController@create')->name('create');
            Route::post('/store','Contact_ratesController@store')->name('store');
            Route::get('/edit/{id}', 'Contact_ratesController@edit')->name('edit');
            Route::post('/update', 'Contact_ratesController@update')->name('update');

        });

        Route::name('relativ_contacts.')->prefix('relativ_contacts')->group(function(){
            Route::get('/','Relative_contactsController@index')->name('index');
            Route::get('/show/{id}','Relative_contactsController@show')->name('show');
            Route::post('/delete', 'Relative_contactsController@destroy')->name('delete');
            Route::get('/create','Relative_contactsController@create')->name('create');
            Route::post('/store','Relative_contactsController@store')->name('store');
            Route::get('/edit/{id}', 'Relative_contactsController@edit')->name('edit');
            Route::post('/update', 'Relative_contactsController@update')->name('update');
            

        });

        Route::name('place_ws.')->prefix('place_ws')->group(function(){
            Route::get('/','Place_wsController@index')->name('index');
            Route::get('/show/{id}','Place_wsController@show')->name('show')->can('contact place details');
            Route::post('/delete', 'Place_wsController@destroy')->name('delete');
            Route::get('/create','Place_wsController@create')->name('create');
            Route::post('/store','Place_wsController@store')->name('store');
            Route::get('/edit/{id}', 'Place_wsController@edit')->name('edit')->can('contact place edit');
            Route::post('/update', 'Place_wsController@update')->name('update');
            
        });

        Route::name('sale_types.')->prefix('sale_types')->group(function(){
            Route::get('/','Sale_typesController@index')->name('index');
            Route::get('/show/{id}','Sale_typesController@show')->name('show');
            Route::post('/delete', 'Sale_typesController@destroy')->name('delete');
            Route::get('/create','Sale_typesController@create')->name('create');
            Route::post('/store','Sale_typesController@store')->name('store');
            Route::post('/storemodel','Sale_typesController@storemodel')->name('storemodel');
            Route::get('/edit/{id}', 'Sale_typesController@edit')->name('edit');
            Route::post('/update', 'Sale_typesController@update')->name('update');
        });

        Route::name('sale_emp_aschiveds.')->prefix('sale_emp_aschiveds')->group(function(){
            Route::get('/','Sale_emp_aschivedsController@index')->name('index');
            Route::get('/show/{id}','Sale_emp_aschivedsController@show')->name('show');
            Route::post('/delete', 'Sale_emp_aschivedsController@destroy')->name('delete');
            Route::get('/create','Sale_emp_aschivedsController@create')->name('create');
            Route::post('/store','Sale_emp_aschivedsController@store')->name('store');
            Route::post('/storemodel','Sale_emp_aschivedsController@storemodel')->name('storemodel');
            Route::get('/edit/{id}', 'Sale_emp_aschivedsController@edit')->name('edit');
            Route::post('/update', 'Sale_emp_aschivedsController@update')->name('update');
        });

        Route::name('emp_sales.')->prefix('emp_sales')->group(function(){
            Route::get('/','Emp_salesController@index')->name('index');
            Route::get('/show/{id}','Emp_salesController@show')->name('show');
            Route::post('/delete', 'Emp_salesController@destroy')->name('delete');
            Route::get('/create','Emp_salesController@create')->name('create');
            Route::post('/store','Emp_salesController@store')->name('store');
            Route::get('/edit/{id}', 'Emp_salesController@edit')->name('edit');
            Route::post('/update', 'Emp_salesController@update')->name('update');
            Route::get('/getprod','Emp_salesController@getprod')->name('getprod');
            Route::get('/getsale_type','Emp_salesController@getsale_type')->name('getsale_type');

        });

        Route::name('hierarchy_emps.')->prefix('hierarchy_emps')->group(function(){
            Route::get('/','Hierarchy_empsController@index')->name('index');
            Route::get('/show/{id}','Hierarchy_empsController@show')->name('show');
            Route::post('/delete', 'Hierarchy_empsController@destroy')->name('delete');
            Route::get('/create','Hierarchy_empsController@create')->name('create');
            Route::post('/store','Hierarchy_empsController@store')->name('store');
            Route::get('/edit/{id}', 'Hierarchy_empsController@edit')->name('edit');
            Route::post('/update', 'Hierarchy_empsController@update')->name('update');
            Route::get('/getGovernorate','Hierarchy_empsController@getGovernorate')->name('getGovernorate');
            Route::get('/getCitiesByGovernorate','Hierarchy_empsController@getCitiesByGovernorate')->name('getCitiesByGovernorate');
            Route::get('/getemrate','Hierarchy_empsController@getemrate')->name('getemrate');

        });

        Route::name('events.')->prefix('events')->group(function(){
            Route::get('/','EventsController@index')->name('index');
            Route::get('/show/{id}','EventsController@show')->name('show')->can('event details');
            Route::post('/delete', 'EventsController@destroy')->name('delete');
            Route::get('/create','EventsController@create')->name('create');
            Route::post('/store','EventsController@store')->name('store');
            Route::get('/edit/{id}', 'EventsController@edit')->name('edit')->can('event edit');
            Route::post('/update', 'EventsController@update')->name('update');
            Route::post('/storeventtype','EventsController@storeventtype')->name('storeventtype');
            Route::get('/showcontent/{id}','EventsController@showcontent')->name('showcontent');

        });

        Route::name('event_contents.')->prefix('event_contents')->group(function(){
            Route::get('/','Event_contentsController@index')->name('index');
            Route::get('/show/{id}','Event_contentsController@show')->name('show');
            Route::post('/delete', 'Event_contentsController@destroy')->name('delete');
            Route::get('/create/{id?}','Event_contentsController@create')->name('create');
            Route::post('/store','Event_contentsController@store')->name('store');
            Route::get('/edit/{id}', 'Event_contentsController@edit')->name('edit');
            Route::post('/update', 'Event_contentsController@update')->name('update');
            Route::post('/storeventtype','Event_contentsController@storeventtype')->name('storeventtype');

        });

        Route::name('typecontacts.')->prefix('typecontacts')->group(function(){
            Route::get('/','Type_contactsController@index')->name('index');
            Route::get('/show/{id}','Type_contactsController@show')->name('show')->can('contact type details');
            Route::post('/delete', 'Type_contactsController@destroy')->name('delete');
            Route::get('/create','Type_contactsController@create')->name('create');
            Route::post('/store','Type_contactsController@store')->name('store');
            Route::get('/edit/{id}', 'Type_contactsController@edit')->name('edit')->can('contact type edit');
            Route::post('/update', 'Type_contactsController@update')->name('update');
            
        });

        Route::name('type_visits.')->prefix('type_visits')->group(function(){
            Route::get('/','Type_visitsController@index')->name('index');
            Route::get('/show/{id}','Type_visitsController@show')->name('show');
            Route::post('/delete', 'Type_visitsController@destroy')->name('delete');
            Route::get('/create','Type_visitsController@create')->name('create');
            Route::post('/store','Type_visitsController@store')->name('store');
            Route::get('/edit/{id}', 'Type_visitsController@edit')->name('edit');
            Route::post('/update', 'Type_visitsController@update')->name('update');
            
        });

        Route::name('technical_supports.')->prefix('technical_supports')->group(function(){
            Route::get('/','Technical_supportsController@index')->name('index');
            Route::get('/show/{id}','Technical_supportsController@show')->name('show');
            Route::post('/delete', 'Technical_supportsController@destroy')->name('delete');
            Route::get('/create','Technical_supportsController@create')->name('create');
            Route::post('/store','Technical_supportsController@store')->name('store');
            Route::get('/edit/{id}', 'Technical_supportsController@edit')->name('edit');
            Route::post('/update', 'Technical_supportsController@update')->name('update');
            
        });

        Route::name('plan_visits.')->prefix('plan_visits')->group(function(){
            Route::get('/','Plan_visitsController@index')->name('index');
            Route::get('/show/{id}','Plan_visitsController@show')->name('show');
            Route::post('/delete', 'Plan_visitsController@destroy')->name('delete');
            Route::get('/create','Plan_visitsController@create')->name('create');
            Route::post('/store','Plan_visitsController@store')->name('store');
            Route::get('/edit/{id}', 'Plan_visitsController@edit')->name('edit');
            Route::post('/update', 'Plan_visitsController@update')->name('update');
            Route::get('/makeduoble/{id}', 'Plan_visitsController@makeduoble')->name('makeduoble');
            
        });

        Route::name('salefunnels.')->prefix('salefunnels')->group(function(){
            Route::get('/','Sales_funelsController@index')->name('index');
            Route::get('/show/{id}','Sales_funelsController@show')->name('show')->can('sale funnel details');
            Route::post('/delete', 'Sales_funelsController@destroy')->name('delete');
            Route::get('/create','Sales_funelsController@create')->name('create');
            Route::post('/store','Sales_funelsController@store')->name('store');
            Route::post('/storemodel','Sales_funelsController@storemodel')->name('storemodel');
            Route::get('/edit/{id}', 'Sales_funelsController@edit')->name('edit')->can('sale funnel edit');
            Route::post('/update', 'Sales_funelsController@update')->name('update');
        });

        Route::name('tools.')->prefix('tools')->group(function(){
            Route::get('/','ToolsController@index')->name('index');
            Route::get('/show/{id}','ToolsController@show')->name('show');
            Route::post('/delete', 'ToolsController@destroy')->name('delete');
            Route::get('/create','ToolsController@create')->name('create');
            Route::post('/store','ToolsController@store')->name('store');
            Route::post('/storetype','ToolsController@storetype')->name('storetype');
            Route::get('/edit/{id}', 'ToolsController@edit')->name('edit');
            Route::post('/update', 'ToolsController@update')->name('update');

        });

        Route::name('visits.')->prefix('visits')->group(function(){
            Route::get('/','VisitsController@index')->name('index');
            Route::get('/show/{id}','VisitsController@show')->name('show');
            Route::post('/delete', 'VisitsController@destroy')->name('delete');
            Route::get('/create','VisitsController@create')->name('create');
            Route::post('/store','VisitsController@store')->name('store');
            Route::get('/edit/{id}', 'VisitsController@edit')->name('edit');
            Route::post('/update', 'VisitsController@update')->name('update');
            Route::get('/editcomment/{id}', 'VisitsController@editcomment')->name('editcomment');
            Route::post('/storecomment','VisitsController@storecomment')->name('storecomment');
            Route::get('/showcomment/{id}', 'VisitsController@showcomment')->name('showcomment');
            Route::get('/indexlist/{list?}/{from_t?}/{to_d?}/{st?}','VisitsController@indexlist')->name('indexlist');
            Route::get('/reportlist','VisitsController@reportlist')->name('reportlist');
            Route::get('/reportprod','VisitsController@reportprod')->name('reportprod');
            Route::get('/reportprodlist/{from_t?}/{to_d?}/{empvisit_id?}','VisitsController@reportprodlist')->name('reportprodlist');
            Route::get('/showlocation/{id}', 'VisitsController@showlocation')->name('showlocation');

            
        });

        Route::name('list_contacs.')->prefix('list_contacs')->group(function(){
            Route::get('/','List_contacsController@index')->name('index');
            Route::get('/show/{id}','List_contacsController@show')->name('show')->can('list details');
            Route::post('/delete', 'List_contacsController@destroy')->name('delete');
            Route::get('/create','List_contacsController@create')->name('create');
            Route::post('/store','List_contacsController@store')->name('store');
            Route::get('/edit/{id}', 'List_contacsController@edit')->name('edit')->can('list edit');
            Route::post('/update', 'List_contacsController@update')->name('update');
            Route::post('/removecenter/{centerId?}/{dataId?}', 'List_contacsController@removecenter')->name('removecenter');
            Route::post('/removecontact/{centerId?}/{dataId?}', 'List_contacsController@removecontact')->name('removecontact');
            Route::post('/addcontact/{centerId?}/{dataId?}', 'List_contacsController@addcontact')->name('addcontact');
            Route::post('/addcenter/{centerId?}/{dataId?}', 'List_contacsController@addcenter')->name('addcenter');
            Route::get('/addcontlist/{id}','List_contacsController@addcontlist')->name('addcontlist');
            Route::post('/storelistdeta','List_contacsController@storelistdeta')->name('storelistdeta');
            Route::get('/indexview/{id?}','List_contacsController@indexview')->name('indexview');
            Route::post('/createfunnel', 'List_contacsController@createfunnel')->name('createfunnel');
            Route::post('/updatefunnel', 'List_contacsController@updatefunnel')->name('updatefunnel');

        });

        Route::name('bill_sales.')->prefix('bill_sales')->group(function(){
            Route::get('/','Bill_sale_headersController@index')->name('index');// can
            Route::get('/show/{id}','Bill_sale_headersController@show')->name('show');
            Route::post('/delete', 'Bill_sale_headersController@destroy')->name('delete');
            Route::get('/create','Bill_sale_headersController@create')->name('create');// can
            Route::post('/store','Bill_sale_headersController@store')->name('store');// can
            Route::get('/edit/{id}', 'Bill_sale_headersController@edit')->name('edit');// can
            Route::post('/update', 'Bill_sale_headersController@update')->name('update');// can
            Route::get('/editsalehead/{id}', 'Bill_sale_headersController@editsalehead')->name('editsalehead');// can
            Route::post('/storepermonesale','Bill_sale_headersController@storepermonesale')->name('storepermonesale');// can
            Route::get('/indexall','Bill_sale_headersController@indexall')->name('indexall'); // can
            Route::get('/indexdelivered','Bill_sale_headersController@indexdelivered')->name('indexdelivered'); // can
            Route::get('/getprodname/{id?}','Bill_sale_headersController@getprodname')->name('getprodname');
            Route::get('/inactivesale/{id}', 'Bill_sale_headersController@inactivesale')->name('inactivesale');
            Route::get('/activesale/{id}', 'Bill_sale_headersController@activesale')->name('activesale');
            Route::get('/deliveredesale/{id}', 'Bill_sale_headersController@deliveredesale')->name('deliveredesale');


        });

        Route::name('emp_bill_sales.')->prefix('emp_bill_sales')->group(function(){
            Route::get('/','Emp_bill_salesController@index')->name('index');
            Route::get('/show/{id}','Emp_bill_salesController@show')->name('show');
            Route::post('/delete', 'Emp_bill_salesController@destroy')->name('delete');
            Route::get('/create','Emp_bill_salesController@create')->name('create');
            Route::post('/store','Emp_bill_salesController@store')->name('store');
            Route::get('/edit/{id}', 'Emp_bill_salesController@edit')->name('edit');
            Route::post('/update', 'Emp_bill_salesController@update')->name('update');
            Route::get('/indexempsearch','Emp_bill_salesController@indexempsearch')->name('indexempsearch');
            Route::get('/indexemp/{from_time?}/{to_date?}','Emp_bill_salesController@indexemp')->name('indexemp');
            Route::get('/inactiveempsale/{id}', 'Emp_bill_salesController@inactiveempsale')->name('inactiveempsale');


        });

        Route::name('temp_sale_recs.')->prefix('temp_sale_recs')->group(function(){
            Route::get('/','Temp_sale_recsController@index')->name('index');
            Route::get('/show/{id}','Temp_sale_recsController@show')->name('show')->can('social style details');
            Route::post('/delete', 'Temp_sale_recsController@destroy')->name('delete');
            Route::get('/create','Temp_sale_recsController@create')->name('create');
            Route::post('/store','Temp_sale_recsController@store')->name('store');
            Route::get('/edit/{id}', 'Temp_sale_recsController@edit')->name('edit')->can('social style edit');
            Route::post('/update', 'Temp_sale_recsController@update')->name('update');

        });
        Route::name('trans_custs.')->prefix('trans_custs')->group(function(){
            Route::get('/','Trans_custsController@index')->name('index');
            Route::get('/show/{id}','Trans_custsController@show')->name('show');
            Route::post('/delete', 'Trans_custsController@destroy')->name('delete');
            Route::get('/create','Trans_custsController@create')->name('create');
            Route::post('/store','Trans_custsController@store')->name('store');
            Route::get('/edit/{id}', 'Trans_custsController@edit')->name('edit');
            Route::post('/update', 'Trans_custsController@update')->name('update');
            
        });
        Route::name('event_atts.')->prefix('event_atts')->group(function(){
            Route::get('/','Event_attsController@index')->name('index');
            Route::get('/show/{id}','Event_attsController@show')->name('show')->can('brand gift details');
            Route::post('/delete', 'Event_attsController@destroy')->name('delete');
            Route::get('/create','Event_attsController@create')->name('create');
            Route::post('/store','Event_attsController@store')->name('store');
            Route::get('/edit/{id}', 'Event_attsController@edit')->name('edit')->can('brand gift edit');
            Route::post('/update', 'Event_attsController@update')->name('update');

        });

        Route::name('cust_payment_methods.')->prefix('cust_payment_methods')->group(function(){
            Route::get('/','Cust_payment_methodsController@index')->name('index');
            Route::get('/show/{id}','Cust_payment_methodsController@show')->name('show');//->can('')
            Route::post('/delete', 'Cust_payment_methodsController@destroy')->name('delete');
            Route::get('/create','Cust_payment_methodsController@create')->name('create');
            Route::post('/store','Cust_payment_methodsController@store')->name('store');
            Route::get('/edit/{id}', 'Cust_payment_methodsController@edit')->name('edit');//->can('')
            Route::post('/update', 'Cust_payment_methodsController@update')->name('update');
            
        });

        Route::name('cust_collections.')->prefix('cust_collections')->group(function(){
            Route::get('/','Cust_collectionsController@index')->name('index');
            Route::get('/show/{id}','Cust_collectionsController@show')->name('show');
            Route::post('/delete', 'Cust_collectionsController@destroy')->name('delete');
            Route::get('/create','Cust_collectionsController@create')->name('create');
            Route::post('/store','Cust_collectionsController@store')->name('store');
            Route::get('/edit/{id}', 'Cust_collectionsController@edit')->name('edit');
            Route::post('/update', 'Cust_collectionsController@update')->name('update');
            
        });
        Route::name('refund_causes.')->prefix('refund_causes')->group(function(){
            Route::get('/','Refund_causesController@index')->name('index');
            Route::get('/show/{id}','Refund_causesController@show')->name('show');
            Route::post('/delete', 'Refund_causesController@destroy')->name('delete');
            Route::get('/create','Refund_causesController@create')->name('create');
            Route::post('/store','Refund_causesController@store')->name('store');
            Route::get('/edit/{id}', 'Refund_causesController@edit')->name('edit');
            Route::post('/update', 'Refund_causesController@update')->name('update');
            
        });
    });
    
});

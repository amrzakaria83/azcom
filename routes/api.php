<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;

/*
|-----------------------------------
| API Routes
|-----------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/profile/{id}',[AuthController::class ,'profile']);
Route::post('/login',[AuthController::class ,'login']);
Route::post('/register',[AuthController::class ,'register']);
Route::post('/udpate-fc-token',[AuthController::class ,'updateFcToken']);
Route::get('/delete-account/{userid}',[AuthController::class ,'deleteaccount']);

Route::get('/settings',[ApiController::class ,'settings']);

Route::get('/get-home-notification/{employee_id}',[ApiController::class ,'getHomeNotification']);
Route::get('/get-all-notification/{employee_id}',[ApiController::class ,'getAllNotification']);
Route::get('/get-events',[ApiController::class ,'getEvents']);
Route::get('/get-event-details/{id}',[ApiController::class ,'getEventDetails']);
Route::get('/get-expenses/{id}',[ApiController::class ,'getExpenses']);
Route::get('/get-expense-details/{id}',[ApiController::class ,'getExpenseDetails']);
Route::post('/request-expense',[ApiController::class ,'requestExpense']);
Route::get('/type-social',[ApiController::class ,'getSocialStyle']);

Route::get('/type-expense',[ApiController::class ,'getExpenseTypes']);
Route::get('/get-vacations/{id}',[ApiController::class ,'getVacations']);
Route::get('/get-vacation-details/{id}',[ApiController::class ,'getVacationDetails']);
Route::post('/request-vacation',[ApiController::class ,'requestVacation']);
Route::get('/get-area',[ApiController::class ,'getArea']);
Route::get('/type-center',[ApiController::class ,'getCenterTypes']);
Route::get('/type-specialty',[ApiController::class ,'getSpecialty']);
Route::get('/type-contact',[ApiController::class ,'getTypeContact']);
Route::post('/request-center',[ApiController::class ,'requestCenter']);
Route::post('/request-contact',[ApiController::class ,'requestContact']);
Route::post('/get-visit-plan',[ApiController::class ,'getVisitPlan']);
Route::get('/type-visit',[ApiController::class ,'getTypeVisit']);
Route::get('/get-center',[ApiController::class ,'getCenter']);
Route::get('/get-contact',[ApiController::class ,'getContact']);
Route::get('/get-product',[ApiController::class ,'getProduct']);
Route::get('/get-employee',[ApiController::class ,'getEmployee']);
Route::post('/add-visit',[ApiController::class ,'addVisit']);
Route::post('/get-visits',[ApiController::class ,'getVisit']);
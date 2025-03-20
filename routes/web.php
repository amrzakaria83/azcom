<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Front\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/lang-change', [HomeController::class ,'changLang'])->name('teacher.lang.change');

Route::post('/loginpost', [ClientLoginController::class ,'clientLogin'])->name('client.loginpost');
Route::post('/registerpost', [ClientLoginController::class ,'clientRegister'])->name('client.registerpost');
Route::get('/logout', [ClientLoginController::class ,'logout'])->name('client.logout');

Route::get('/', [AdminLoginController::class ,'showAdminLoginForm'])->name('public.login');

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::get('/','HomeController@index')->name('index');
Route::get('/about','HomeController@about')->name('about');
Route::get('/contact-us','HomeController@contact')->name('contact');
Route::post('/contact-submit','HomeController@contactSubmit')->name('contactsubmit');
Route::get('/blogs','HomeController@blogs')->name('blogs');
Route::get('/blog-details/{id}','HomeController@blogDetails')->name('blogDetails');
Route::get('/partners','HomeController@partners')->name('partners');
Route::get('/services','HomeController@services')->name('services');
Route::get('/service-details/{id}','HomeController@serviceDetails')->name('serviceDetails');
Route::get('/service-details-account/{id}','HomeController@serviceDetailsaccount')->name('serviceDetailsaccount');
Route::get('/service-details-account/{id}/{user_id}','HomeController@serviceDetailsaccountuser')->name('serviceDetailsaccountuser');
Route::post('/servicesubmit','HomeController@servicesubmit')->name('servicesubmit');
Route::get('/treemodel/{id}','HomeController@treemodel')->name('treemodel');
Route::get('/booking/{id}','HomeController@booking')->name('booking');
Route::post('/order','HomeController@order')->name('order');

Route::get('/servicemodal/{id}','HomeController@servicemodal')->name('servicemodal');
Route::post('/order-success','HomeController@orderSuccess')->name('ordersuccess');
Route::post('/search','HomeController@search')->name('search');
Route::get('/policy','HomeController@policy')->name('policy');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/my-account','HomeController@myaccount')->name('myaccount');
});
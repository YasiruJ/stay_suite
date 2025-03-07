<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('privacy-policy', [HomeController::class, 'showPrivacyPolicy'])->name('home.privacy');
Route::get('terms-and-conditions', [HomeController::class, 'showTermsConditions'])->name('home.terms-conditions');
Route::get('contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('contact/send', [HomeController::class, 'contactInfo']);

//home routes

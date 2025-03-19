<?php

// use App\Http\Controllers\Antrian\RadiologyController;

use App\Http\Controllers\Antrian\RadiologyController;
use App\Http\Controllers\Antrian\Table\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Antrian\Table\PasienController;
use App\Http\Controllers\Antrian\Table\VideoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\ReportController;
use App\Http\Controllers\Pages\RoomController;
use App\Http\Controllers\Pages\TransactionController;
use App\Http\Controllers\Pages\TrashController;
use App\Http\Controllers\Pages\TypeTrashController;
use App\Http\Controllers\Pages\UserController;
use App\Models\MWLWL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', function () {
    return view('bank_sampah.welcome');
})->name('welcome');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.update');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/home', [HomeController::class, 'home'])->middleware('auth')->name('home');

Route::resource('/type', TypeTrashController::class)->middleware('auth');
Route::resource('/trash', TrashController::class)->middleware('auth');
Route::resource('/room', RoomController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::resource('/report', ReportController::class)->middleware('auth');
Route::resource('/transaction', TransactionController::class)->middleware('auth');

Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


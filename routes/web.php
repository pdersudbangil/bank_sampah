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
use App\Http\Controllers\RecycleBin\ReportsController;
use App\Http\Controllers\RecycleBin\RoomsController;
use App\Http\Controllers\RecycleBin\TransactionsController;
use App\Http\Controllers\RecycleBin\TrashesController;
use App\Http\Controllers\RecycleBin\TypeTrashesController;
use App\Http\Controllers\RecycleBin\UsersController;
use App\Models\MWLWL;
use App\Models\Transaction;
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

Route::prefix('bank_sampah')->group(function () {
    Route::resource('/type', TypeTrashController::class)->middleware('auth');
    Route::resource('/trash', TrashController::class)->middleware('auth');
    Route::resource('/room', RoomController::class)->middleware('auth');
    Route::resource('/user', UserController::class)->middleware('auth');
    Route::resource('/report', ReportController::class)->middleware('auth');
    Route::resource('/transaction', TransactionController::class)->middleware('auth');
    Route::post('/view_transaction', [TransactionController::class, 'updateTransaction']);
});

Route::prefix('recycle_bin')->group(function () {
    Route::resource('/types', TypeTrashesController::class)->middleware('auth');
    Route::resource('/trashes', TrashesController::class)->middleware('auth');
    Route::resource('/rooms', RoomsController::class)->middleware('auth');
    Route::resource('/users', UsersController::class)->middleware('auth');
    Route::resource('/reports', ReportsController::class)->middleware('auth');
    Route::resource('/transactions', TransactionsController::class)->middleware('auth');
    Route::post('/reports/restore/{id}', [ReportsController::class, 'restore'])->name('reports.restore');
});

Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


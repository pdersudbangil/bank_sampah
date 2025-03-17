<?php

// use App\Http\Controllers\Antrian\RadiologyController;

use App\Http\Controllers\Antrian\RadiologyController;
use App\Http\Controllers\Antrian\Table\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Antrian\Table\PasienController;
use App\Http\Controllers\Antrian\Table\VideoController;
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
});

Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('firebase_data',[FirebaseController::class,'fetchData']);
Route::get('/',[FirebaseController::class,'index']);
Route::post('/',[FirebaseController::class,'store'])->name('image.store');
//user
Route::get('/users/index',[UserController::class,'index']);
Route::post('/users/store',[UserController::class,'dataStore'])->name('data.store');
Route::post('/users/processdata',[UserController::class,'processData'])->name('data.process');

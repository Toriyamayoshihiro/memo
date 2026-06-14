<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

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

Route::get('/', [MemoController::class, 'index']);

Route::get('/memo/create', [MemoController::class, 'getMemorize']);
Route::post('/memo/create',[MemoController::class,'memorize']);

Route::get('/memo/{memo_id}',[MemoController::class,'detail']);

Route::get('/memo/{memo_id}/edit',[MemoController::class,'edit_display']);
Route::post('/memo/{memo_id}/edit',[MemoController::class,'edit']);


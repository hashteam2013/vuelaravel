<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('event/list',[App\Http\Controllers\EventController::class, 'list'])->name('events.list');
Route::post('event/create',[App\Http\Controllers\EventController::class,'create'])->name('events.create');
Route::get('event/edit/{id}',[App\Http\Controllers\EventController::class,'get'])->name('events.edit');
Route::post('event/update',[App\Http\Controllers\EventController::class,'update'])->name('events.update');
Route::post('event/delete',[App\Http\Controllers\EventController::class,'delete'])->name('events.delete');
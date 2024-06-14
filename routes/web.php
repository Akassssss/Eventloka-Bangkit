<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;



Route::get('/',[SessionController::class, 'index']);
Route::get('/register',[SessionController::class, 'indexRegister']);
Route::post('/register',[SessionController::class, 'storeRegister']);
Route::get('/login',[SessionController::class, 'indexLogin']);
Route::get('/logout',[SessionController::class, 'logout']);
Route::post('/login',[SessionController::class, 'processLogin']);
Route::get('/initiator',[SessionController::class, 'indexInit']);
Route::get('/organizer',[SessionController::class, 'indexOrg']);
Route::get('/initiator/create',[EventController::class, 'indexCreateEvent']);

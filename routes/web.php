<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['notLogin'])->group(function(){
    Route::get('/',[SessionController::class, 'index']);
    Route::get('/register',[SessionController::class, 'indexRegister']);
    Route::post('/register',[SessionController::class, 'storeRegister']);
    Route::get('/login',[SessionController::class, 'indexLogin']);
    Route::post('/login',[SessionController::class, 'processLogin']);
});

Route::middleware(['isLogin'])->group(function(){
    
    Route::get('/logout',[SessionController::class, 'logout']);

    Route::middleware(['initiator'])->group(function(){

        Route::get('/initiator',[EventController::class, 'indexInit']);
        Route::get('/initiator/create',[EventController::class, 'indexCreateEvent']);
        Route::post('/initiator/create',[EventController::class, 'storeEvent']);
        Route::get('/initiator/event/{id}/find',[EventController::class, 'findEvent']);
        Route::put('/initiator/event/{id}/find',[EventController::class, 'pickFindEvent']);
        Route::get('/initiator/event/{id}',[EventController::class, 'detailEvent']);
        Route::get('/initiator/event/{id}/edit',[EventController::class, 'editDetailEvent']);
        Route::put('/initiator/event/{id}/edit',[EventController::class, 'updateDetailEvent']);
        Route::get('/initiator/event/{id}/request',[EventController::class, 'requestEvent']);
        Route::put('/initiator/event/{id}/request',[EventController::class, 'acceptRequestEvent']);
        Route::get('/initiator/event/{id}/ongoing',[EventController::class, 'ongoingEventInit']);
        Route::put('/initiator/event/{id}/ongoing',[EventController::class, 'updateOngoingEventInit']);
        Route::get('/initiator/event/{id}/done',[EventController::class, 'doneEventInit']);
        Route::get('/initiator/my',[EventController::class, 'myEventInit']);
        Route::get('/initiator/profile',[EventController::class, 'profileInit']);
        
    });

    Route::middleware(['organizer'])->group(function(){
         
        Route::get('/organizer',[EventController::class, 'indexOrg']);
        Route::get('/organizer/available',[EventController::class, 'indexAvailableOrg']);
        Route::get('/organizer/detail/{id}',[EventController::class, 'detailAvailableOrg']);
        Route::put('/organizer/take/{id}',[EventController::class, 'takeEvent']);
        Route::get('/organizer/event',[EventController::class, 'indexEventOrg']);
        Route::get('/organizer/my',[EventController::class, 'myEventOrg']);
        Route::get('/organizer/event/{id}/request',[EventController::class, 'requestEventOrg']);
        Route::put('/organizer/event/{id}/request',[EventController::class, 'updateRequestEventOrg']);
        Route::get('/organizer/event/{id}/ongoing',[EventController::class, 'ongoingEventOrg']);
        Route::put('/organizer/event/{id}/ongoing',[EventController::class, 'updateOngoingEventOrg']);
        Route::get('/organizer/event/{id}/done',[EventController::class, 'doneEventOrg']);
        Route::get('/organizer/profile',[EventController::class, 'profileOrg']);
        Route::get('/organizer/editprofile',[EventController::class, 'editProfileOrg']);
        Route::put('/organizer/editprofile',[EventController::class, 'updateProfileOrg']);
        // Route::get('/organizer',[EventController::class, 'indexOrg']);

    });

});
// Route::get('/',[SessionController::class, 'index']);
// Route::get('/register',[SessionController::class, 'indexRegister']);
// Route::post('/register',[SessionController::class, 'storeRegister']);
// Route::get('/login',[SessionController::class, 'indexLogin']);
// Route::post('/login',[SessionController::class, 'processLogin']);


// Route::get('/logout',[SessionController::class, 'logout']);
// Route::get('/initiator',[SessionController::class, 'indexInit']);
// Route::get('/organizer',[SessionController::class, 'indexOrg']);
// Route::get('/initiator/create',[EventController::class, 'indexCreateEvent']);
// Route::post('/initiator/create',[EventController::class, 'storeEvent']);

// Route::post('/predict', [EventController::class, 'predict']);


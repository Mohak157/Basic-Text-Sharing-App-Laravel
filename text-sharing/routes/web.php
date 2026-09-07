<?php

use App\Http\Controllers\MsgController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Logout;

Route::get('/',[MsgController::class,'index']);

Route::middleware('auth')->group(function(){
    Route::post('/messages',[MsgController::class,'store']);
    Route::get('/messages/{message}/edit',[MsgController::class,'edit']);
    Route::put('/messages/{message}',[MsgController::class,'update']);
    Route::delete('/messages/{message}',[MsgController::class,'destroy']);

});

Route::view('/register','auth.register') ->middleware('guest')->name('register');
Route::post('/register',Register::class)->middleware('guest');
Route::post('/logout',Logout::class)->middleware('auth');
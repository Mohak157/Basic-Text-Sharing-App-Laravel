<?php

use App\Http\Controllers\MsgController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MsgController::class,'index']);
Route::post('/messages',[MsgController::class,'store']);
Route::get('/messages/{message}/edit',[MsgController::class,'edit']);
Route::put('/messages/{message}',[MsgController::class,'update']);
Route::delete('/messages/{message}',[MsgController::class,'destroy']);

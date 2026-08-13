<?php

use App\Http\Controllers\MsgController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MsgController::class,'index']);
Route::post('messages',[MsgController::class,'store']);
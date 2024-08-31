<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MonthlyAttendanceScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/welcome',[AttendanceController::class,'getAllData']);
Route::get('/aylik',[MonthlyAttendanceScoreController::class,'getAllData']);


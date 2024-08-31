<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MonthlyAttendanceScoreController;
use App\Http\Controllers\UserGeniController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Orion\Facades\Orion;
use Laravel\Sanctum;



Route::group(['as' => 'api.'], function() {
    Orion::resource('user-geni', UserGeniController::class)->middleware('auth:sanctum');
    Orion::resource('attendace', AttendanceController::class)
        ->middleware(['auth:sanctum', 'checkAttendance']);
    Orion::resource('monthly-attendace', MonthlyAttendanceScoreController::class)->middleware('auth:sanctum');
});

Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');










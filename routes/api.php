<?php

use App\Http\Controllers\Api\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthenticateController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest'])->name('auth.')->group(function () {
    Route::post('/login', [AuthenticateController::class, 'login'])->name('login');
});

Route::middleware(['auth:sanctum'])->name('reports.')->group(function () {
    Route::post('/generate-report', [ReportController::class, 'store'])->name('store');
    Route::get('/list-reports', [ReportController::class, 'index'])->name('index');
    Route::get('/get-report/{report}', [ReportController::class, 'show'])->name('show');
    Route::delete('/delete-report/{report}', [ReportController::class, 'destroy'])->name('destroy');
});

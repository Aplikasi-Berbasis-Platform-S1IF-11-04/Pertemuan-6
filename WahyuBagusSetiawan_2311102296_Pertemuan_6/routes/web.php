<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentRegistryController;

// Rute untuk menampilkan antarmuka utama dashboard
Route::get('/', [StudentRegistryController::class, 'index']);

// API Group untuk Standar Keamanan & Struktur RESTful
Route::prefix('api/v1')->group(function () {
    Route::get('/students', [StudentRegistryController::class, 'getStudentRegistry']);
});
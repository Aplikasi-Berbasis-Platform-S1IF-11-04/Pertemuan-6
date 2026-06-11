<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MahasiswaController::class, 'index']);

Route::get('/api/mahasiswa', [MahasiswaController::class, 'getJsonData']);

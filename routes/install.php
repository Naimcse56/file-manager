<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallerController;

Route::get('/', [InstallerController::class, 'first_step'])->name('install.first_step');
Route::get('/install/second-step', [InstallerController::class, 'second_step'])->name('install.second_step');
Route::post('/install/setup', [InstallerController::class, 'third_step'])->name('install.third_step');
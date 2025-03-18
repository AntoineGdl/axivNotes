<?php

use App\Http\Controllers\DepenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Put the export route BEFORE the resource route
Route::get('/depenses/export', [DepenseController::class, 'export'])->name('depenses.export');

// Then the resource routes
Route::resource('depenses', DepenseController::class);

Route::post('/categories', [App\Http\Controllers\CategorieController::class, 'store'])->name('categories.store');

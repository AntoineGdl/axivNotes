<?php

use App\Http\Controllers\DepenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('depenses', DepenseController::class);

Route::post('/categories', [App\Http\Controllers\CategorieController::class, 'store'])->name('categories.store');

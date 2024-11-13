<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('tasks', TaskController::class)->middleware('auth');

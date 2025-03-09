<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

// Home route - Use the app layout
Route::get('/', function () {
    return view('layouts.app');
});

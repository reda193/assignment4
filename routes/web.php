<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

// Home route - Use the app layout
Route::get('/', function () {
    return view('layouts.app');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/manage', [TodoController::class, 'index'])->name('manage');
    Route::post('/manage/add-item', [TodoController::class, 'addItem'])->name('todo.add');
    Route::post('/manage/clear-list', [TodoController::class, 'clearList'])->name('todo.clear');
    Route::post('/manage/save-list', [TodoController::class, 'saveList'])->name('todo.save');
    Route::post('/manage/restore-list', [TodoController::class, 'restoreList'])->name('todo.restore');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/manage');
    }
    
    return app(AuthController::class)->showLoginForm();
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/manage');
    }
    
    return app(AuthController::class)->showRegistrationForm();
})->name('register');

Route::get('/auth-detailed', function () {
    $isLoggedIn = Auth::check();
    $userData = $isLoggedIn ? Auth::user()->toArray() : null;
    $session = session()->all();
        
    return [
        'authenticated' => $isLoggedIn,
        'user' => $userData,
        'session_data' => $session,
        'request_info' => [
            'path' => request()->path(),
            'url' => request()->url(),
            'method' => request()->method(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]
    ];
});
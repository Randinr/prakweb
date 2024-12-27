<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

Route::get('/pp', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register/save', [AuthController::class, 'saveRegister'])->name('register.save');
Route::post('/login/process', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
});

Route::get('/berita', function () {
    return view('berita');
})->name('berita');


Route::middleware('auth')->group(function () {    
Route::get('/addNews', function () {         
    return view('addNews'); 
}); 
Route::get("/news", [NewsController::class, 'index'])->name('index.index'); 
Route::post('/news/save', [NewsController::class, 'saveNews'])->name('news.save'); 
Route::get('/newsEdit{id_news}', [NewsController::class, 'editNews'])->name('index.edit'); 
Route::put('/newsUpdate{id_news}', [NewsController::class,'updateNews'])->name('index.update'); 
Route::get('/newsDelete{id_news}', [NewsController::class, 'deleteNews'])->name('index.delete'); 
}); 	


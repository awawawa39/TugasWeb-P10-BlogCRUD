<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; // 1. Tambahkan import controller di sini

Route::get('/', function () {
    return view('welcome');
});

// 2. Tambahkan Route Resource untuk CRUD Posts
Route::resource('posts', PostController::class);
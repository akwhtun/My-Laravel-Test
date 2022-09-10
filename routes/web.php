<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\HTTP;

Route::redirect('/', 'createPage')->name('post#home');

Route::get('/createPage', [PostController::class, 'create'])->name('post#home');

Route::post('post/create', [PostController::class, 'postCreate'])->name('post#create');

Route::get('/post/delete/{id}', [PostController::class, 'postDelete'])->name('post#delete');

// Route::delete('/post/delete/{id}', [PostController::class, 'postDelete'])->name('post#delete');

Route::get('/post/view/{id}', [PostController::class, 'postView'])->name('post#view');

Route::get('/post/edit/{id}', [PostController::class, 'postEdit'])->name('post#edit');

Route::post('/post/update', [PostController::class, 'postUpdate'])->name('post#update');
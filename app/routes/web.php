<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', fn () => view('admin.index'))->name('admin.index');
    });

    Route::middleware(['role:admin,accountant'])->group(function () {
        Route::get('/accounts', fn () => view('accounts.index'))->name('accounts.index');
    });
});
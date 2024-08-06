<?php

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
    ->namespace('App\Http\Controllers\Admin')
    ->prefix('admin/user')
    ->name('admin.user.')
    ->group(function () {

    Route::get('/administrators', function () {
        return view('dashboard');
    })->name('administrators');

    Route::get('/suppliers', function () {
        return view('dashboard');
    })->name('suppliers');

    Route::get('/customers', function () {
        return view('dashboard');
    })->name('customers');


});

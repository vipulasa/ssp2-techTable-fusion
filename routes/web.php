<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-guard', function () {
    // create an administrator and login that account in the admin guard
    $admin = App\Models\Administrator::create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('password'),
    ]);

    auth()->guard('admin')->login($admin);


    return view('dashboard');
});

Route::middleware([
    'role:Admin,Customer',
])->get('/dev', function () {

    dd(\Illuminate\Support\Facades\Gate::allows(
        'check_role',
        'Customer'
    ));

    dd(auth()->user()->role == App\Enums\Role::Customer);
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

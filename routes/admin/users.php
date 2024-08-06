<?php
/**
 * Administrator User Routes
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Admin',
])
    ->namespace('App\Http\Controllers\Admin\Users')
    ->prefix('admin/user')
    ->name('admin.user.')
    ->group(function () {

        // Administrators
        Route::resource('/administrators', AdministratorsController::class);

        // Suppliers
        Route::resource('/suppliers', SuppliersController::class);

        // Customers
        Route::resource('/customers', CustomersController::class);
    });

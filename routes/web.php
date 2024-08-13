<?php

use App\Http\Controllers\HomeController;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin/users.php';

Route::get('/', HomeController::class);










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




Route::get('/qr-sample/{id?}', function ($id) {
    $svg = (new Writer(
        new ImageRenderer(
            new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
            new SvgImageBackEnd
        )
    ))->writeString('Adoo - ' . $id);

    return trim(substr($svg, strpos($svg, "\n") + 1));
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

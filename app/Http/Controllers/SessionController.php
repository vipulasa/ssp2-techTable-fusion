<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        // method one
        // session(['name' => 'Adoo']);

        // method two
//        session()->put('name', [
//            'name' => 'john',
//            'products' => (new Product())->get()
//        ]);
//
//        session()->remove('name');

        // method three (Temp session) FLASH
        // session()->flash('name', 'John');

        dd(\Session::get('name'), $request->session()->get('name'));

        return view('session.index');
    }
}

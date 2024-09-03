<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function index()
    {

        // both are the same
        // cache()->put('products', (new Product())->get(), 60);

        // but this is sexy
        // Cache::put('products', (new Product())->get(), 60);

        // check if a cache exists for products
        if(Cache::has('products')) {
            $products = Cache::get('products');
        } else {
            $products = (new Product())->get();
            Cache::put('products', $products, 60);
        }

        return view('cache.index', [
            'products' => $products,
        ]);
    }
}

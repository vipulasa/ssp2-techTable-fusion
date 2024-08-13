<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order', 'asc')
            ->get();

        $products = Product::where('status', 1)
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}

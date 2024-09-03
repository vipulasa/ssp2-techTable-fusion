<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function index()
    {

        // This is one method to log an error
        try {

            // throw an exception
            throw new \Exception('This is an exception');

        } catch (\Exception $e) {

            // log the error
            Log::error($e->getMessage());
        }

        // This is another method to log an error
        $products = rescue(function () {

            return (new Product())->get();

        }, function ($e) {
            Log::error('An error occurred');

            return collect([]);
        });

        dd('here');
    }
}

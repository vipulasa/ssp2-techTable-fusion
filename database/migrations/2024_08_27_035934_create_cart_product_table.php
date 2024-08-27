<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignId('cart_id');
            $table->foreignId('product_id');
            $table->integer('quantity')->default(1);
            $table->double('total', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};

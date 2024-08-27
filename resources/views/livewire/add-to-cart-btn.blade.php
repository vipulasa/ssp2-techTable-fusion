<?php

use function Livewire\Volt\{state, mount};

state([
    'product' => null
]);

mount(function () {

});

$addToCart = function () {

    // check if the user is logged in
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // check if the user already has an active cart
    $cart = (new \App\Models\Cart())
        ->where('user_id', auth()->id())
        ->where('is_paid', 0)
        ->first();

    // if no cart is found, create a new one
    if (!$cart) {
        $cart = (new \App\Models\Cart())->create([
            'user_id' => auth()->id(),
            'is_paid' => 0,
            'total' => 0
        ]);
    }

    // check if the product exists in the cart
    $product = $cart->products()->where('product_id', $this->product->id)->first();

    // if found, increment the quantity
    if($product){
        $product->pivot->quantity += 1;
        $product->pivot->total += $this->product->price;
        $product->pivot->save();
    }else{
        // add the product to the cart
        $cart->products()->attach($this->product->id, [
            'quantity' => 1,
            'total' => $this->product->price
        ]);
    }

    // calculate the cart total and update the cart
    $cart->total = $cart->products()->sum('total');

    $cart->save();

    // emit event to open the cart
    $this->dispatch('openCart');

};

?>

<div class="mt-4">
    <button wire:click="addToCart" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add to Cart
    </button>
</div>

<?php

use function Livewire\Volt\{state, mount, on};

state([
    'cart' => null,
    'show_cart' => false
]);

mount(function () {
    $this->cart = (new \App\Models\Cart())
        ->where('user_id', auth()->id())
        ->where('is_paid', 0)
        ->with('products')
        ->first();
});

// listen to the event openCart and show the cart
on(['openCart' => function () {
    $this->show_cart = true;
}]);

$removeProduct = function ($product_id) {
    // remove the product from the cart based on the ID
    $this->cart->products()->detach($product_id);
};

?>

<div x-data="{ open: @entangle('show_cart') }">
    <div class="fixed bottom-3 right-3">
        <a href="#" class="group -m-2 flex items-center p-2" x-on:click="open = true">
            <svg class="h-20 w-20 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
            </svg>
            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">
                {{ $cart->products->count() }}
            </span>
            <span class="sr-only">items in cart, view bag</span>
        </a>
    </div>

    <div x-show="open" class="relative z-10"
         aria-labelledby="slide-over-title" role="dialog"
         aria-modal="true">
        <div x-show="open" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             x-description="Background backdrop, show/hide based on slide-over state."
             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">

                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                     x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping
                                        cart</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button"
                                                x-on:click="open = false"
                                                class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            @if($cart->products->count())
                                                @foreach($cart->products as $product)
                                                    <li class="flex py-6">
                                                        <div
                                                            class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                            <img
                                                                src="{{ $product->getFirstMediaUrl('featured') }}"
                                                                alt="{{ $product->title }}"
                                                                class="h-full w-full object-cover object-center">
                                                        </div>

                                                        <div class="ml-4 flex flex-1 flex-col">
                                                            <div>
                                                                <div
                                                                    class="flex justify-between text-base font-medium text-gray-900">
                                                                    <h3>
                                                                        <a href="#">{{ $product->name }}</a>
                                                                    </h3>
                                                                    <p class="ml-4">$ {{ $product->price }}</p>
                                                                </div>
                                                                <p class="mt-1 text-sm text-gray-500">{{ $product->description }}</p>
                                                            </div>
                                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                                <p class="text-gray-500">
                                                                    Qty {{ $product->pivot->quantity }}</p>

                                                                <div class="flex">
                                                                    <button type="button"
                                                                            wire:click="removeProduct({{ $product->id }})"
                                                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                        Remove
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li>
                                                    Sorry, your cart is empty
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p>${{ $cart->total }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <a href="#"
                                       class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        or
                                        <button type="button" x-on:click="open = false"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Continue Shopping
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

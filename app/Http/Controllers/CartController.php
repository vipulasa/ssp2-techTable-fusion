<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function checkOut(Request $request)
    {

        // check if the user has a cart and has products in it
        $cart = (new Cart())
            ->where('user_id', auth()->id())
            ->where('is_paid', 0)
            ->first();

        // if not cart is found, send the user back to the home page
        if (!$cart) {
            return redirect()->route('home');
        }

        // if the cart is found but has no products, send the user back to the home page
        if ($cart->products->count() == 0) {
            return redirect()->route('home');
        }

        return view('checkout', [
            'cart' => $cart,
            'user' => auth()->user(),
        ]);
    }

    public function completeOrder(Request $request)
    {
        // validate
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'nullable',
            'address' => 'required',
            'apartment' => 'nullable',
            'city' => 'required',
            'country' => 'required',
            'region' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'card_number' => 'required',
            'name_on_card' => 'required',
            'expiration_date' => 'required',
            'cvc' => 'required',
        ]);

        // create an order
        $order = (new Order())->create([
            'user_id' => auth()->id(),
            'cart_id' => $request->cart_id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'country' => $request->country,
            'region' => $request->region,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'card_number' => $request->card_number,
            'name_on_card' => $request->name_on_card,
            'expiration_date' => $request->expiration_date,
            'cvc' => $request->cvc,
            'status' => 'complete'
        ]);

        return redirect()->route('checkout.confirm', $order->id);
    }

    public function orderConfirmation(Request $request, Order $order)
    {
        return view('thank_you', [
            'order' => $order
        ]);
    }
}

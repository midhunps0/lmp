<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\Cart;
use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
  public function index()
  {
  }
  public function checkout()
  {
    $cartItems = Cart::all(); // Adjust this based on your cart implementation

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return view('checkout', ['sessionId' => $session->id]);
  }
  public function succes(){

  }
  public function cancel(){
    
  }

 
}

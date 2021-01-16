<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\CheckoutRequest;

class CheckOutController extends Controller
{

    public function index()
    {
        
        return view('checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),   
        ]);
        // return view('checkout');
    }

    public function store(CheckoutRequest $request)
    {   

        $contents = Cart::content()->map(function($item){
            return $item->model->slug.', '.$item->quantity;
        })->values()->toJson();

        try {

            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('newTotal'),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description'=>'Order',
                'receipt_email'=> $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' =>collect(session()->get('coupon'))->toJson(),
                ],
            ]);
            //successful
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            // return back()->with('success_message', 'Thank u! Your payment has been successful accepted!');
            return redirect()->route('Confirmation.index')->with('success_message', 'Thank u! Your payment has been successful accepted!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error!' . $e->getMessage());
        }
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
        'tax' => $tax,
        'discount' => $discount,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Validation\Validator;

class CartController extends Controller
{

    /**
     * show related products in cart blade
     */
    public function index()
    {
        $relatedproduct = Product::RelatedProducts()->get();
        return view('cart')->with('relatedproduct', $relatedproduct);
    }

    /**
     * items stored in cart
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('Cart.index')->with('success_message', 'This Item is already in your cart!');
        }

        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');

        return redirect()->route('Cart.index')->with('success_message', 'Item was added to your cart');
    }

    public function update(Request $request, $id)
    {
        
        
         Cart::update($id, $request->qty);

         session()->flash('success_message', 'Quantity was updated successfully!');
         return response()->json(['success' => true]);
    }
    /**
     * items remove form cart
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Item hsa been remove!');

    }

    /**
     * Switch item from cart to save for later
     */
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('Cart.index')->with('success_message', 'This Item is already Save for Later!');
        }


        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        return redirect()->route('Cart.index')->with('success_message', 'Item has been save for Later!');
    }
}

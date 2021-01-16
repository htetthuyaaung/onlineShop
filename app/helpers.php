<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function presentPrice($price)
{
    return money_format('$i', $price / 100);
}

// function setActiveCategory($category, $output = 'active')
// {
//     return request()->categroy == $category? $output : '';
// }

// function getNumbers()
// {
// $tax = config('cart.tax') / 100;
// $discount = session()->get('coupon')['discount'] ?? 0;
// $code = session()->get('coupon')['name'] ?? null;
// $newSubtotal = (Cart::subtotal() - $discount);  //The error points to this line
// if ($newSubtotal < 0) {
//     $newSubtotal = 0;
// }
// $newTax = $newSubtotal * $tax;
// $newTotal = $newSubtotal * (1 + $tax);

// return collect([
//     'tax' => $tax,
//     'discount' => $discount,
//     'code' => $code,
//     'newSubtotal' => $newSubtotal,
//     'newTax' => $newTax,
//     'newTotal' => $newTotal,
// ]);
//  }
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index()
    {
        $pagination = 9;
        $categories = Category::all();

        if ( request()->category ) {

            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;

        } else {

            $products = Product::where('featured', true);
            $categoryName = 'ကြိုတင်မှာ ယူနိုင်သည့် ပစ္စည်းများ';
        }

        if(request()->sort == 'low_high'){
            $products = $products->orderBy('price')->paginate($pagination);
        }else if(request()->sort == 'high_low'){
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        }else{
            $products = $products->paginate($pagination);
        }
        // $users = User::paginate(15)->fragment('users');



        $popularproduct = Product::inRandomOrder()->take(5)->get();

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName'=> $categoryName,
            'popularproduct' => $popularproduct
        ]);
    }


    public function create()
    {
    }



    public function store(Request $request)
    {
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedproduct = Product::where('slug', '!=', $slug)->inRandomOrder()->take(5)->get();
        return view('detail')->with([
            'product' => $product,
            'relatedproduct' => $relatedproduct
        ]);
    }


    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

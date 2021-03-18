<?php

namespace App\Http\Controllers\Front;

use App\BusinessLocation;
use App\VariationLocationDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Front\Cart;
use App\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with('product_variations.variations.product')->whereIn('id', $variation_location_product_ids)->get();
        $special_cat = Category::with('sub_categories')->where('name', 'like', '%special%')->where('parent_id', 0)->first();
        $all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        // return $special_cat;
        // return $products[0]->product_variations[0]->variations;
        // return $products->product_variations[0]->variations[0]->default_sell_price;
        // return $products;
        return view('ecommerce.shop')->with('products', $products)
            ->with('special_category', $special_cat)
            ->with('categories', $all_categories);
    }

    public function product($slug)
    {
        $product = Variation::with('product')->where('sub_sku', $slug)->first();
        $product_cat = $product->product->category_id;
        $location = BusinessLocation::where('name', 'freshktm')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with('product_variations.variations.product')->where('category_id', $product_cat)->whereIn('id', $variation_location_product_ids)->get();
        // dd($product_cat);
        // dd($product->product);
        // dd($product);
        // $variation = $this->product_variations();
        // return view('ecommerce.shop');
        // $shops = $this->shops->get();
        // dd($product->get('name'));
        // dd($product->variations[0]);
        return view('ecommerce.product_single')->with('variation', $product)
            ->with('products', $products);
    }
    public function checkout()
    {
        $user_id = Auth::guard('customer')->user()->id;
        $cart_items = Cart::with('variation')->where('user_id', $user_id)->get();
        $total_price = Cart::where('user_id', $user_id)->sum('total_price');

        return view('ecommerce.checkout')->with('cart_items', $cart_items)
            ->with('total_sum', $total_price);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

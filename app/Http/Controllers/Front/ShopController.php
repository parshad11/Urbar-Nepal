<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
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
        $products = Product::with('product_variations.variations.product')->get();
//        return $products[0]->product_variations[0]->variations;
//        return $products->product_variations[0]->variations[0]->default_sell_price;
//        return $products;
        return view('ecommerce.shop')->with('products', $products);
    }

    public function product($id)
    {
        // dd($id);
        $business_id = request()->session()->get('user.business_id');
        $product = Product::join('variations as v', 'v.product_id', '=', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', '=', 'v.id')
//            ->where('products.business_id', $business_id)
            ->where('products.id', $id)
            ->select(
                'products.id',
                'products.image',
                'products.name',
                DB::raw('SUM(vld.qty_available) as current_stock'),
        )->first();

        // dd($product);
        // $variation = $this->product_variations();
        // return view('ecommerce.shop');
        // $shops = $this->shops->get();
        // dd($product->get('name'));
        // dd($product->variations[0]);
        return view('ecommerce.product_single')->with('product', $product);
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

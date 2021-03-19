<?php

namespace App\Http\Controllers\Front;

use App\Front\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variation;
use App\VariationLocationDetails;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        $total_price = Cart::where('user_id', auth()->guard('customer')->user()->id)->sum('total_price');
        // return $cart_items[0]->product->name;
        return view('ecommerce.cart')->with('cart_items', $cart_items)
            ->with('total_sum', $total_price);
    }

    public function addToCart(Request $request)
    {
        // dd($request);
        // return $request->product_id;
        $user_id = Auth::guard('customer')->user()->id;
        $cart_items = Cart::where('user_id', $user_id)->get();
        $variation_product = Variation::with('product')->find($request->product_id);
        $variation_stock = VariationLocationDetails::where('variation_id',$variation_product->id)->first();
            // return $variation_stock;
            if($request->quantity > $variation_stock){
                return 'Stock not available';
            }
        $data = array();
        $data['id'] = $variation_product->id;
        $data['user_id'] = $user_id;
        // $str = '';
        // $tax = 0;
        // dd($product);

        $data['quantity'] = isset($request->quantity) ? $request->quantity : 1;
        $data['total_price'] = $data['quantity'] * $variation_product->sell_price_inc_tax;
        if ($cart_items) {
            $foundInCart = false;
            $cart = collect();
            foreach ($cart_items as $key => $cartItem) {
                if ($cartItem['product_id'] == $variation_product->id) {
                    $foundInCart = true;
                    $cartItem['quantity'] += $request->quantity;
                    $cartItem['total_price'] = $cartItem['quantity'] * $variation_product->sell_price_inc_tax;
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {

                $cart->push($data);
            }
        } else {
            $cart = collect([$data]);
        }
        $cart_data = array();
        foreach ($cart as $key => $value) {
            $cart_db = Cart::updateOrCreate(
                [
                    'product_id' => $value['id'],
                    'user_id' => $value['user_id'],
                ],
                [
                    'product_id' => $value['id'],
                    'user_id' => $value['user_id'],
                    'quantity' => $value['quantity'],
                    'total_price' => $value['total_price']
                ]
            );
            array_push($cart_data, $cart_db);
        }
        return $cart_data;
        // return view('ecommerce.cart', compact('product', 'data'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

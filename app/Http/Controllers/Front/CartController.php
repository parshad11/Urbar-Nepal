<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variation;
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
        //
        // dd('test');
        return  view('ecommerce/cart');
    }

    public function addToCart(Request $request)
    {
        // dd($request);
        // return $request->product_id;
        $user_id = Auth::guard('customer')->user()->id;
        $variation_product = Variation::with('product')->find($request->product_id);
        $data = array();
        $data['id'] = $variation_product->id;
        $data['user_id'] = $user_id;
        // $str = '';
        // $tax = 0;
        // dd($product);


        $data['quantity'] = isset($request->quantity) ? $request->quantity : 1;
        // $data['tax'] = $tax;
        // $data['shipping'] = $product->shipping_cost;
        //  dd( $request['quantity']);
        // return response()->json($data);

        if ($request->session()->has('cart')) {
            $foundInCart = false;
            $cart = collect();
            foreach ($request->session()->get('cart') as $key => $cartItem) {
                if ($cartItem['id'] == $variation_product->id) {
                    $foundInCart = true;
                    $cartItem['quantity'] += 1;
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {

                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        } else {
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }
        return $request->session()->get('cart');
        // dd('tesst');
        // dd($cartItem['quantity'] );
        // Session::all();
        // dd($request->session()->all());

        // dd('yes');
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

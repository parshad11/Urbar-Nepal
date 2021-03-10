<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

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
        $product = Product::find($request->product_id);
        // $data = array();
        $data['id'] = $product->id;
        // $str = '';
        // $tax = 0;
// dd($product);
        
   
        $data['quantity'] = $request['quantity'];
        $data['price'] = $request['price'];
        // $data['tax'] = $tax;
        // $data['shipping'] = $product->shipping_cost;
//  dd( $request['quantity']);

        if ($request['quantity'] == null){
            $data['quantity'] = 1;
        }
        if($request->session()->has('cart')){

            $foundInCart = false;
            $cart = collect();
                // dd($request->id);
            foreach ($request->session()->get('cart') as $key => $cartItem){
                if($cartItem['id'] == $product->id){
                    // dd('test');
                        
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    
                }
                $cart->push($cartItem);
            }
            
            if (!$foundInCart) {
                
                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        }
        else{
            $cart = collect([$data]);
            // dd($cart);
            $request->session()->put('cart', $cart);
        }

        // dd('tesst');
        // dd($cartItem['quantity'] );
        // Session::all();
        dd($request->session()->all());

        // dd('yes');
        return view('ecommerce.cart', compact('product', 'data'));
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

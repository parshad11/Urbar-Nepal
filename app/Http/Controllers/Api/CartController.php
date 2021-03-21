<?php

namespace App\Http\Controllers\Api;

use App\Front\Cart;
use App\Variation;
use App\VariationLocationDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contact;

class CartController extends Controller
{
	public function index()
	{
		$cart_items = Cart::with('variation')->where('user_id', auth()->guard('customerapi')->user()->id)->get();
		$total_price = Cart::where('user_id', auth()->guard('customerapi')->user()->id)->sum('total_price');
		return response()->json([
			'cart_item'=>$cart_items,
			'total_price'=>$total_price,
		]);
	}

	public function addToCart(Request $request)
	{
		$user_id = Auth::guard('customerapi')->user()->id;
		$cart_items = Cart::where('user_id', $user_id)->get();
		$variation_product = Variation::with('product')->find($request->product_id);
		$variation_stock = VariationLocationDetails::where('variation_id', $variation_product->id)->first();
		if ($request->quantity > $variation_stock->qty_available) {
			return response()->json(['status'=>'error', 'msg' => 'Quantity is not available']);
		}
		$data = array();
		$data['product_id'] = $variation_product->id;
		$data['user_id'] = $user_id;
		$data['quantity'] = isset($request->quantity) ? $request->quantity : 1;
		$data['total_price'] = $data['quantity'] * $variation_product->sell_price_inc_tax;
		if ($cart_items) {
			$foundInCart = false;
			$cart = collect();
			foreach ($cart_items as $key => $cartItem) {
				if ($cartItem['product_id'] == $variation_product->id) {
					$variation_stock = VariationLocationDetails::where('variation_id', $variation_product->id)->first();
					$foundInCart = true;
					if ($cartItem['quantity'] >= $variation_stock->qty_available) {
						return response()->json(['status'=>'error', 'message' => 'Quantity is not available']);
					}
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
					'product_id' => $value['product_id'],
					'user_id' => $value['user_id'],
				],
				[
					'product_id' => $value['product_id'],
					'user_id' => $value['user_id'],
					'quantity' => $value['quantity'],
					'total_price' => $value['total_price']
				]
			);
			array_push($cart_data, $cart_db);
		}
		return response()->json(['status'=>'success','msg'=> 'Product Added to Cart Successfully', 'data'=>$cart_data]);
	}

	public function removeFromCart(Request $request){
		return 'success';
	}
}

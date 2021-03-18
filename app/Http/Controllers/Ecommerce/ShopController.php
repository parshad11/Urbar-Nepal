<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ShopController extends Controller
{
   public function viewShop(){
    $products = Product::with('variations')->get();
    $categories = Category::with('sub_categories')->where('parent_id', 0)->get();
   //  $sub_categories = Category::where()get();
    // return view('ecommerce.shop');
    // $shops = $this->shops->get();
   //  dd($cat->name);
  
    return view('ecommerce.shop')->with('products', $products)->with('categories', $categories);
   }

   public function product($id){
      // dd($id);
      $product = Product::with('variations')->where('id', $id)->first();
      // $variation = $this->product_variations();
      // return view('ecommerce.shop');
      // $shops = $this->shops->get();
      // dd($product->get('name'));
      // dd($product->variations[0]);
      return view('ecommerce.product_single')->with('product', $product);
     }
}

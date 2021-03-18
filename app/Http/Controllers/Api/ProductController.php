<?php

namespace App\Http\Controllers\api;

use App\BusinessLocation;
use App\VariationLocationDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variation;
use App\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function products()
    {

    $location=BusinessLocation::where('name','freshktm')->first();
    $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id',$location->id)->pluck('product_id')->toArray();
    $products = Product::with('product_variations.variations.product')->whereIn('id',$variation_location_product_ids)->get();

    return response()->json([ 
        'product' => $products 
     ]);
     
    }

    public function product($slug)
    {
      $product = Variation::with('product')->where('sub_sku' ,$slug)->first();
        
      if (!$product) {
        return response()->json(["message" => 'Product Not Found!']);
      }

      return response()->json([
        'product' => $product 
     ]);

    }


    public function variation($slug)
    {
      $product = Variation::with('product')->where('sub_sku' ,$slug)->first();
      $product_cat = $product->product->category_id;
      $location=BusinessLocation::where('name','freshktm')->first();
      $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id',$location->id)->pluck('product_id')->toArray();
      $products = Product::with('product_variations.variations.product')->where('category_id',$product_cat)->whereIn('id',$variation_location_product_ids)->get();

        return response()->json([          
          'variation'=>$products      
       ]);
    }
}

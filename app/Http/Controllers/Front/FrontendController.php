<?php

namespace App\Http\Controllers\Front;

use App\Front\PageSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VendorRequestMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Front\Banner;
use App\Front\SliderBanner;
use App\Category;
use App\Front\BlogCategory;
use App\Front\Blog;
use App\BusinessLocation;
use App\VariationLocationDetails;
use App\Front\Cart;
use App\Front\Document;
use App\Product;
use App\Front\FrontAbout;
use App\Front\HomeSetting;


use function GuzzleHttp\json_decode;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $home_settings = HomeSetting::latest()->first();
        $category = Category::with('sub_categories')->where('parent_id','=',0)->get();
        $sub_category = Category::with('sub_categories')->where('parent_id','!=',0)->get();
        $banners = Banner::where('status', 'active')->latest()->get();
        $slider_banners = SliderBanner::where('status', 'active')->latest()->get();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->whereIn('id', $variation_location_product_ids)->orderBy('id','desc')->get();
        $special_category = Category::with('sub_categories')->where('name', 'like', '%special%')->where('parent_id', 0)->first();
        if ($special_category == null) {
            $categories = Category::with('sub_categories')->where('parent_id', 0)->active()->orderBy('display_order')->get();
        } else {
            $categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_category->id)->active()->orderBy('display_order')->get();
        }
        $cart_items=null;
        if(auth()->guard('customer')->user()){
           
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        $featured_products =Product::whereIn('id', $variation_location_product_ids)->where('set_featured',1)->get();
        // $catalogues=Document::where('file_type','catalogue')->limit('2')->latest()->get();
        // $banner = Document::where('file_type','banner')->first();
        return view('ecommerce.index')->with(compact('products', 'special_category','categories','banners','slider_banners','cart_items','home_settings','category','sub_category','featured_products'));
    }

    public function getAbout()
    {
        $home_settings = HomeSetting::select('welcome_description')->first();
        $about_details = FrontAbout::first();
       
        $cart_items=null;
        if(auth()->guard('customer')->user()){
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        return view('ecommerce.about_page')->with('about_info', $about_details)
        ->with('about_content', $home_settings->welcome_description)
        ->with('cart_items', $cart_items);
    }

    public function latestProduct()
    {
        $home_settings = HomeSetting::latest()->first();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->whereIn('id', $variation_location_product_ids)->latest()->paginate(5);
        $cart_items=null;
        if(auth()->guard('customer')->user()){
           
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        
        return view('ecommerce.latest_product')->with(compact('products','cart_items','home_settings'));
    }
    public function featureProduct(Request $request)
    {
        $home_settings = HomeSetting::latest()->first();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $featured_products =Product::whereIn('id', $variation_location_product_ids)->where('set_featured',1)->paginate(2);
        // return response()->json($featured_products);
        $cart_items=null;
        if(auth()->guard('customer')->user()){
           
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        // if ($request->ajax()) {
        // return view('ecommerce.feature_product')->with(compact('featured_products','cart_items'));
        // }
        return view('ecommerce.feature_product')->with(compact('featured_products','cart_items','home_settings'));
    }
    
    public function getBlog()
    {
        $categories = BlogCategory::latest()->get();
        $blogs = Blog::where('status','active')->latest()->get();
        $cart_items=null;
        if(auth()->guard('customer')->user()){
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        return view('ecommerce.blog',compact('categories','blogs','cart_items'));
       
    }
    
    public function mailRequest(Request $request)
    {
        try{
            Mail::to(Config::get('mail.from.address'))->send(new VendorRequestMail($request));
            $request->session()->flash('success', 'Your message has been sent to Urbar Nepal');
        
        } catch (Exception $ex) {
            $request->session()->flash('error', 'Something went wrong');
        }
      
        return redirect()->route('front_dashboard');
    }

    public function getSingleBlog($slug)
    {
        //$about_details = FrontAbout::select('banner_image')->first();
        $categories = BlogCategory::with('news')->orderBy('id', 'desc')->get();
        $blog_single = Blog::where('slug', $slug)->first();
        $blogs = Blog::orderBy('created_at', 'desc')->latest()->limit(5)->get();
        $cart_items=null;
        if(auth()->guard('customer')->user()){
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        return view('ecommerce.blog_single')
           // ->with('about_info', $about_details)
            ->with('blog_single', $blog_single)
            ->with('categories', $categories)
            ->with('cart_items', $cart_items)
            ->with('blogs', $blogs);
       
    }

    public function getContact()
    {
        $home_settings = HomeSetting::first();
        $cart_items=null;
        if(auth()->guard('customer')->user()){
            $cart_items = Cart::with('variation')->where('user_id', auth()->guard('customer')->user()->id)->get();
        }
        return view('ecommerce.contact',compact('home_settings','cart_items'));
    }

    public function getPages($slug)
    {
        $page_info = PageSetting::where('slug', $slug)->first();
        return view('ecommerce.login');
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

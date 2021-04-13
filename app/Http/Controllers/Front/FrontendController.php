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
        $banners = Banner::where('status', 'active')->latest()->get();
        $slider_banners = SliderBanner::where('status', 'active')->latest()->get();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->whereIn('id', $variation_location_product_ids)->latest()->get();
        $featured_products =Product::whereIn('id', $variation_location_product_ids)->where('set_featured',1)->get();
      
         
        return view('ecommerce.index')->with(compact('banners','slider_banners','products','featured_products'));
        // return view('ecommerce.index',compact('banners','slider_banners'));
    }

    public function getAbout()
    {
         $home_settings = HomeSetting::select('welcome_description')->first();
        $about_details = FrontAbout::first();
        return view('ecommerce.about_page')->with('about_info', $about_details)
            ->with('about_content', $home_settings->welcome_description);
    }

    public function getBlog()
    {
        $categories = BlogCategory::latest()->get();
        $blogs = Blog::where('status','active')->latest()->get();
        //return response()->json($blogs);
        return view('ecommerce.blog',compact('categories','blogs'));
       
    }
    
    public function mailRequest(Request $request)
    {
        Mail::to(Config::get('mail.from.address'))->send(new VendorRequestMail($request));
        return redirect()->back();
    }
    public function getSingleBlog($slug)
    {
        //$about_details = FrontAbout::select('banner_image')->first();
        $categories = BlogCategory::with('news')->orderBy('id', 'desc')->get();
        $blog_single = Blog::where('slug', $slug)->first();
        $blogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
      //  return response()->json($categories);
        return view('ecommerce.blog_single')
           // ->with('about_info', $about_details)
            ->with('blog_single', $blog_single)
            ->with('categories', $categories)
            
            ->with('blogs', $blogs);
       
    }

    public function getContact()
    {
        return view('ecommerce.contact');
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

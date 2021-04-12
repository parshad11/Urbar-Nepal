<?php

namespace App\Http\Controllers\Front;

use App\CategoryVisit;
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
        $category=Category::orderBy('view','desc')->orderBY('created_at','desc')->limit(3)->get();
        $category_product=Product::with(['product_variations.variations.product', 'unit'])->whereIn('id', $variation_location_product_ids)->where('category_id','!=',null)->latest()->get();
            return view('ecommerce.index')->with(compact('banners','slider_banners','products','category','category_product'));
    }

    public function getAbout()
    {
        return view('ecommerce.about');
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

<?php

namespace App\Http\Controllers\Front;

use App\Front\PageSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VendorRequestMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Front\BlogCategory;
use App\Front\Blog;


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
        return view('ecommerce.index');
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
        return view('frontcms.page');
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

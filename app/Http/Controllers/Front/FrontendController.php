<?php

namespace App\Http\Controllers\Front;

use App\Front\PageSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VendorRequestMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

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
        return view('ecommerce.about_us');
    }

    public function getBlog()
    {
        return view('ecommerce.blog');
    }

    public function mailRequest(Request $request)
    {
        Mail::to(Config::get('mail.from.address'))->send(new VendorRequestMail($request));
        return redirect()->back();
    }



    public function getSingleBlog($slug)
    {
        return view('ecommerce.blog_single');
    }

    public function getContact()
    {
        return view('ecommerce.contact_us');
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

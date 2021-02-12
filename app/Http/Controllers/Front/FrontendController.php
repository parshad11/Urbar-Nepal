<?php

namespace App\Http\Controllers\Front;

use App\Front\HomeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function GuzzleHttp\json_decode;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_settings = HomeSetting::first();
        // $home_setting = json_decode($home_settings->why_choose_us, true);
        // dd($home_setting['Agriculture Leader']);
        // $home_setting = explode(',',str_replace('+', ' ', $home_settings->why_choose_us));
        // foreach($home_setting as $key => $value){
        //     list($k, $v) = explode('=', $value);
        //     $result[ $k ] = $v;
        // }
        return view('frontcms.index')->with('home_setting',$home_settings);
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

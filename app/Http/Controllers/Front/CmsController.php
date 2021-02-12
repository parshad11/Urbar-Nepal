<?php

namespace App\Http\Controllers\Front;

use App\Front\HomeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Util;

class CmsController extends Controller
{
    protected $setting;
    protected $util;
    public function __construct(HomeSetting $settings, Util $util)
    {
        $this->setting = $settings;
        $this->util = $util;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontcms.create-setting-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['logo_image'] = $this->util->uploadHomeFile($request->logo_image[0], config('constants.product_img_path') . '/home');
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;

        $banner_photos = array();
        if ($request->hasFile('banner_images')) {
            foreach ($request->banner_images as $key => $photo) {
                $banner = $this->util->uploadHomeFile($photo, config('constants.product_img_path') . '/home');
                array_push($banner_photos, $banner);
            }
        }
        $data['banner_images'] = implode(",", $banner_photos);

        // $data['why_choose_us'] = http_build_query(array_combine($request->why_title, $request->why_description),'',',');
        $data['why_choose_us'] = json_encode(array_combine($request->why_title, $request->why_description));

        $data['welcome_image'] = $this->util->uploadHomeFile($request->welcome_image[0], config('constants.product_img_path') . '/home');
        $data['welcome_description'] = $request->welcome_description;

        $data['vdo_image'] = $this->util->uploadHomeFile($request->vdo_image[0], config('constants.product_img_path') . '/home');
        $data['vdo_link'] = $request->video_link;

        $data['faqs'] = json_encode(array_combine($request->faq, $request->faq_ans));
        $data['social_links'] = json_encode(array_combine($request->site, $request->sitelink));

        $data['call_section_image'] = $this->util->uploadHomeFile($request->call_section_image[0], config('constants.product_img_path') . '/home');
        $data['counter_section_image'] = $this->util->uploadHomeFile($request->counter_section_image[0], config('constants.product_img_path') . '/home');
        $data['quote_background_image'] = $this->util->uploadHomeFile($request->quote_back_image[0], config('constants.product_img_path') . '/home');
        $data['quote_front_image'] = $this->util->uploadHomeFile($request->quote_front_image[0], config('constants.product_img_path') . '/home');

        $client_photos = array();
        if ($request->hasFile('client_images')) {
            foreach ($request->client_images as $key => $photo) {
                $banner = $this->util->uploadHomeFile($photo, config('constants.product_img_path') . '/home');
                array_push($client_photos, $banner);
            }
        }
        $data['client_images'] = implode(",", $client_photos);
        $data['google_map_link'] = $request->google_map_link;
        $data['created_by'] = $request->session()->get('user.id');
        $this->setting->fill($data);
        $status = $this->setting->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => __('product.product_added_success')
            ];
            return redirect()->route('frontcms-settings.create')->with('status', $output);
        }
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

    public function createAbout(){
        return view('frontcms.about_form');
    }
}

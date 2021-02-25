<?php

namespace App\Http\Controllers\Front;

use App\Front\Blog;
use App\Front\Faq;
use App\Front\FrontAbout;
use App\Front\HomeSetting;
use App\Front\Service;
use App\Front\Team;
use App\Front\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Util;
use Illuminate\Support\Str;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class CmsController extends Controller
{
    protected $setting;
    protected $util;
    protected $about;
    protected $team;
    protected $service;
    protected $blog;
    public function __construct(HomeSetting $settings, Util $util, FrontAbout $frontAbout, Team $team, Service $service, Blog $blog)
    {
        $this->setting = $settings;
        $this->util = $util;
        $this->about = $frontAbout;
        $this->team = $team;
        $this->service = $service;
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->setting->first();
        if (!$data) {
            return redirect()->route('frontcms-settings.create');
        }
        return view('frontcms.edit_setting')->with('setting', $data);
        // $setting = $this->setting->first();
        // dd(explode(',', $setting->client_images));
        // dd(json_decode($setting->faqs, true));
        // return view('frontcms.edit_setting')->with('setting', $setting);
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
        if ($request->hasFile('logo_image')) {
            $data['logo_image'] = $this->util->uploadHomeFile($request->logo_image[0], config('constants.product_img_path') . '/home');
        }
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

        if ($request->hasFile('welcome_image')) {
            $data['welcome_image'] = $this->util->uploadHomeFile($request->welcome_image[0], config('constants.product_img_path') . '/home');
        }
        $data['welcome_description'] = $request->welcome_description;

        if ($request->hasFile('vdo_image')) {
            $data['vdo_image'] = $this->util->uploadHomeFile($request->vdo_image[0], config('constants.product_img_path') . '/home');
        }
        $data['vdo_link'] = $request->video_link;

        $data['faqs'] = json_encode(array_combine($request->faq, $request->faq_ans));
        $data['social_links'] = json_encode(array_combine($request->site, $request->sitelink));


        if ($request->hasFile('call_section_image')) {
            $data['call_section_image'] = $this->util->uploadHomeFile($request->call_section_image[0], config('constants.product_img_path') . '/home');
        }
        if ($request->hasFile('counter_section_image')) {
            $data['counter_section_image'] = $this->util->uploadHomeFile($request->counter_section_image[0], config('constants.product_img_path') . '/home');
        }
        if ($request->hasFile('quote_back_image')) {
            $data['quote_background_image'] = $this->util->uploadHomeFile($request->quote_back_image[0], config('constants.product_img_path') . '/home');
        }
        if ($request->hasFile('quote_front_image')) {
            $data['quote_front_image'] = $this->util->uploadHomeFile($request->quote_front_image[0], config('constants.product_img_path') . '/home');
        }
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
                'msg' => 'Settings Added Successfully!'
            ];
            return redirect()->route('frontcms-settings.index')->with('status', $output);
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
        // dd($request->all());
        $this->setting = $this->setting->find($id);
        // dd($this->setting);
        $data['logo_image'] = $request->previous_logo_image;
        if ($request->has('logo_image')) {
            $data['logo_image'] = $this->util->uploadHomeFile($request->logo_image[0], config('constants.product_img_path') . '/home');
        }
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;

        if ($request->has('previous_banner_images')) {
            $banner_photos = $request->previous_banner_images;
        } else {
            $banner_photos = array();
        }
        if ($request->hasFile('banner_images')) {
            foreach ($request->banner_images as $key => $photo) {
                $banner = $this->util->uploadHomeFile($photo, config('constants.product_img_path') . '/home');
                array_push($banner_photos, $banner);
            }
        }
        $data['banner_images'] = implode(",", $banner_photos);

        // $data['why_choose_us'] = http_build_query(array_combine($request->why_title, $request->why_description),'',',');
        $data['why_choose_us'] = json_encode(array_combine($request->why_title, $request->why_description));

        $data['welcome_image'] = $request->previous_welcome_image;
        if ($request->has('welcome_image')) {
            $data['welcome_image'] = $this->util->uploadHomeFile($request->welcome_image[0], config('constants.product_img_path') . '/home');
        }
        $data['welcome_description'] = $request->welcome_description;

        $data['vdo_image'] = $request->previous_vdo_image;
        if ($request->has('vdo_image')) {
            $data['vdo_image'] = $this->util->uploadHomeFile($request->vdo_image[0], config('constants.product_img_path') . '/home');
        }
        // $data['vdo_image'] = $this->util->uploadHomeFile($request->vdo_image[0], config('constants.product_img_path') . '/home');
        $data['vdo_link'] = $request->video_link;

        $data['faqs'] = json_encode(array_combine($request->faq, $request->faq_ans));
        $data['social_links'] = json_encode(array_combine($request->site, $request->sitelink));

        $data['call_section_image'] = $request->previous_call_section_image;
        if ($request->has('call_section_image')) {
            $data['call_section_image'] = $this->util->uploadHomeFile($request->call_section_image[0], config('constants.product_img_path') . '/home');
        }
        // $data['call_section_image'] = $this->util->uploadHomeFile($request->call_section_image[0], config('constants.product_img_path') . '/home');
        $data['counter_section_image'] = $request->previous_counter_section_image;
        if ($request->has('counter_section_image')) {
            $data['counter_section_image'] = $this->util->uploadHomeFile($request->counter_section_image[0], config('constants.product_img_path') . '/home');
        }
        // $data['counter_section_image'] = $this->util->uploadHomeFile($request->counter_section_image[0], config('constants.product_img_path') . '/home');
        $data['quote_background_image'] = $request->previous_quote_background_image;
        if ($request->has('quote_back_image')) {
            $data['quote_background_image'] = $this->util->uploadHomeFile($request->quote_back_image[0], config('constants.product_img_path') . '/home');
        }
        // $data['quote_background_image'] = $this->util->uploadHomeFile($request->quote_back_image[0], config('constants.product_img_path') . '/home');
        $data['quote_front_image'] = $request->previous_quote_front_image;
        if ($request->has('quote_front_image')) {
            $data['quote_front_image'] = $this->util->uploadHomeFile($request->quote_front_image[0], config('constants.product_img_path') . '/home');
        }
        // $data['quote_front_image'] = $this->util->uploadHomeFile($request->quote_front_image[0], config('constants.product_img_path') . '/home');

        if ($request->has('previous_client_images')) {
            $client_photos = $request->previous_client_images;
        } else {
            $client_photos = array();
        }
        // $client_photos = array();
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
        // dd($this->setting);
        $status = $this->setting->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => "Settings Updated Successfully"
            ];
            return redirect()->route('frontcms-settings.index')->with('status', $output);
        }
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

    public function createAbout()
    {
        return view('frontcms.about_form');
    }

    public function storeAbout(Request $request)
    {

        if ($request->hasFile('banner_image')) {
        $data['banner_image'] = $this->util->uploadHomeFile($request->banner_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['what_sub_title'] = $request->what_sub_title;
        $data['what_description'] = $request->what_description;
        if ($request->hasFile('banner_image')) {
        $data['what_image'] = $this->util->uploadHomeFile($request->what_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['why_sub_title'] = $request->why_sub_title;
        $data['why_description'] = $request->why_description;
        if ($request->hasFile('banner_image')) {
        $data['why_image'] = $this->util->uploadHomeFile($request->why_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['why_short_points'] = json_encode($request->why_short_points);
        $data['added_by'] = $request->session()->get('user.id');
        $this->about->fill($data);
        $status = $this->about->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'About Settings Added Successfuly'
            ];
            return redirect()->route('frontcms_about_edit')->with('status', $output);
        }
    }

    public function editAbout()
    {
        $data = FrontAbout::first();
        if (!$data) {
            return redirect()->route('frontcms_about_form');
        }
        return view('frontcms.about_edit')->with('about_info', $data);
    }

    public function updateAbout(Request $request)
    {
        $setting_id = $request->setting_id;
        $settings = FrontAbout::where('id', $setting_id)->first();
        $data['banner_image'] = $request->previous_banner_image;
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $this->util->uploadHomeFile($request->banner_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['what_sub_title'] = $request->what_sub_title;
        $data['what_description'] = $request->what_description;
        $data['what_image'] = $request->previous_what_image;
        if ($request->hasFile('what_image')) {
            $data['what_image'] = $this->util->uploadHomeFile($request->what_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['why_sub_title'] = $request->why_sub_title;
        $data['why_description'] = $request->why_description;
        $data['why_image'] = $request->previous_why_image;
        if ($request->hasFile('why_image')) {
            $data['why_image'] = $this->util->uploadHomeFile($request->why_image[0], config('constants.product_img_path') . '/home/about');
        }
        $data['why_short_points'] = json_encode($request->why_short_points);
        $settings->fill($data);
        $settings->save();
        if ($settings) {
            $output = [
                'success' => 1,
                'msg' => 'About Settings Updated Successfuly'
            ];
            return redirect()->route('frontcms_about_edit')->with('status', $output)
                ->with('about_info', $settings);
        }
    }

    public function viewTeam()
    {
        $teams = $this->team->get();
        return view('frontcms.team.index')->with('teams', $teams);
    }
    public function createTeam()
    {
        return view('frontcms.team.team_form');
    }
    public function storeTeam(Request $request)
    {

        $this->team->name = $request->name;
        $this->team->post = $request->post;
        $this->team->social_links = json_encode(array_combine($request->social_name, $request->social_link));
        $this->team->added_by = $request->session()->get('user.id');
        $this->team->member_image = $this->util->uploadHomeFile($request->member_image[0], config('constants.product_img_path') . '/home/team');
        $status = $this->team->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Team Member Added Successfuly'
            ];
            return redirect()->route('cms_team')->with('status', $output);
        }
    }
    public function editTeam(Request $request, $id)
    {
        $team = $this->team = $this->team->find($id);
        return view('frontcms.team.edit')->with('member_info', $team);
    }

    public function updateTeam(Request $request, $id)
    {
        // dd($request->all());
        $this->team = $this->team->find($id);
        $this->team->name = $request->name;
        $this->team->post = $request->post;
        $this->team->social_links = json_encode(array_combine($request->social_name, $request->social_link));
        $this->team->status = $request->status;
        $this->team->member_image = $request->previous_member_image;
        if ($request->hasFile('member_image')) {
            $this->team->member_image = $this->util->uploadHomeFile($request->member_image[0], config('constants.product_img_path') . '/home/team');
        }
        $status = $this->team->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Team Member Updated Successfuly'
            ];
            return redirect()->route('cms_team_edit', $this->team->id)->with('status', $output);
        }
    }

    public function viewServices()
    {
        $services = $this->service->get();
        return view('frontcms.service.index')->with('services', $services);
    }

    public function createServices()
    {
        return view('frontcms.service.form');
    }

    public function storeServices(Request $request)
    {
        $data['title'] = $request->title;
        $data['summary'] = $request->summary;
        $data['service_image'] = $this->util->uploadHomeFile($request->service_image[0], config('constants.product_img_path') . '/home/services');
        $data['added_by'] = $request->session()->get('user.id');
        $this->service->fill($data);
        $status = $this->service->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Service Added Successfuly'
            ];
            return redirect()->route('cms_service_form')->with('status', $output);
        }
    }

    public function editServices($id)
    {
        $this->service = $this->service->where('id', $id)->first();
        return view('frontcms.service.service_edit')->with('service_info', $this->service);
    }

    public function updateServices(Request $request, $id)
    {
        $this->service = $this->service->where('id', $id)->first();
        $this->service->title = $request->title;
        $this->service->summary = $request->summary;
        $this->service->status = $request->status;
        $this->service->service_image = $request->previous_service_image;
        // dd($this->service);
        if ($request->hasFile('service_image')) {
            $this->service->service_image = $this->util->uploadHomeFile($request->service_image[0], config('constants.product_img_path') . '/home/services');
        }
        $status = $this->service->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Service Added Successfuly'
            ];
            return redirect()->route('cms_service')->with('status', $output);
        }
    }
    public function viewBlog()
    {
        $services = $this->service->get();
        return view('frontcms.blog.index')->with('services', $services);
    }

    public function createBlog()
    {
        return view('frontcms.blog.blog_form');
    }

    public function storeBlog(Request $request)
    {
        $data['title'] = $request->title;
        $data['slug'] =  Str::slug($request->title);
        $data['summary'] = $request->summary;
        $data['description'] = $request->description;
        $data['image'] = $this->util->uploadHomeFile($request->blog_image[0], config('constants.product_img_path') . '/home/blogs');
        $data['added_by'] = $request->session()->get('user.id');
        $this->blog->fill($data);
        $status = $this->blog->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Blog Added Successfuly'
            ];
            return redirect()->route('cms_blog_form')->with('status', $output);
        }
    }

    public function editBlog($id)
    {
        $this->blog = $this->blog->where('id', $id)->first();
        return view('frontcms.service.service_edit')->with('service_info', $this->service);
    }

    public function updateBlog(Request $request, $id)
    {
        $this->service = $this->service->where('id', $id)->first();
        $this->service->title = $request->title;
        $this->service->summary = $request->summary;
        $this->service->status = $request->status;
        $this->service->service_image = $request->previous_service_image;
        // dd($this->service);
        if ($request->hasFile('service_image')) {
            $this->service->service_image = $this->util->uploadHomeFile($request->service_image[0], config('constants.product_img_path') . '/home/services');
        }
        $status = $this->service->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Service Added Successfuly'
            ];
            return redirect()->route('cms_service')->with('status', $output);
        }
    }

    public function viewTestimonial()
    {
        $testimonials = Testimonial::get();
        // dd($testimonials);
        return view('frontcms.testimonial.index')->with('testimonials', $testimonials);
    }
    public function createTestimonial()
    {
        return view('frontcms.testimonial.testimonial_form');
    }
    public function storeTestimonial(Request $request)
    {
        $testimonial = new Testimonial();
        $data['name'] = $request->name;
        $data['post'] = $request->post;
        $data['comment'] = $request->comment;
        $data['image'] = $this->util->uploadHomeFile($request->testimonial_image[0], config('constants.product_img_path') . '/home/testimonials');
        $data['added_by'] = $request->session()->get('user.id');
        $testimonial->fill($data);
        $status = $testimonial->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Testimonial Added Successfuly'
            ];
            return redirect()->route('cms_testimonial_form')->with('status', $output);
        }
    }
    public function editTestimonial($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        // dd($testimonial->name);
        return view('frontcms.testimonial.edit')->with('testimonial_info', $testimonial);
    }

    public function updateTestimonial($id, Request $request)
    {
        $testimonial = new Testimonial();
        $testimonial = $testimonial->find($id);
        $testimonial->name = $request->name;
        $testimonial->post = $request->post;
        $testimonial->comment = $request->comment;
        $testimonial->status = $request->status;
        $testimonial->image = $request->previous_image;
        // dd($this->service);
        if ($request->hasFile('testimonial_image')) {
            $testimonial->image = $this->util->uploadHomeFile($request->testimonial_image[0], config('constants.product_img_path') . '/home/testimonials');
        }
        // dd($testimonial);
        $status = $testimonial->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Testimonial Updated Successfuly'
            ];
            return redirect()->route('cms_testimonial')->with('status', $output);
        }
    }
    public function viewFaq()
    {
        $faq = Faq::get();
        // dd($testimonials);
        return view('frontcms.faq.index')->with('faq', $faq);
    }
    public function createFaq()
    {
        return view('frontcms.faq.form');
    }
    public function storeFaq(Request $request)
    {
        $faq = new Faq();
        $faq->summary = $request->summary;
        $faq->qnans = json_encode(array_combine($request->qn, $request->ans));
        $faq->added_by = $request->session()->get('user.id');
        // dd($faq);
        $status = $faq->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Faq Added Successfuly'
            ];
            return redirect()->route('cms_faq_form')->with('status', $output);
        }
    }
    public function editFaq($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        // dd($testimonial->name);
        return view('frontcms.testimonial.edit')->with('testimonial_info', $testimonial);
    }

    public function updateFaq($id, Request $request)
    {
        $testimonial = new Testimonial();
        $testimonial = $testimonial->find($id);
        $testimonial->name = $request->name;
        $testimonial->post = $request->post;
        $testimonial->comment = $request->comment;
        $testimonial->status = $request->status;
        $testimonial->image = $request->previous_image;
        // dd($this->service);
        if ($request->hasFile('testimonial_image')) {
            $testimonial->image = $this->util->uploadHomeFile($request->testimonial_image[0], config('constants.product_img_path') . '/home/testimonials');
        }
        // dd($testimonial);
        $status = $testimonial->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Testimonial Updated Successfuly'
            ];
            return redirect()->route('cms_testimonial')->with('status', $output);
        }
    }
}

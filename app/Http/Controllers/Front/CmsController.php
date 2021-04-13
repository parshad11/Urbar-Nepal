<?php

namespace App\Http\Controllers\Front;

use App\Front\Blog;
use App\Front\Frontabout;
use App\Front\BlogCategory;
use App\Front\HomeSetting;
use App\Front\PageSetting;
use App\Front\Banner;
use App\Front\SliderBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Util;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function GuzzleHttp\json_encode;

class CmsController extends Controller
{
    protected $setting;
    protected $util;
    protected $blog;
    protected $about;
    protected $banner;
    protected $slider_banner;


    public function __construct(HomeSetting $settings, Util $util, Blog $blog, Banner $banner, SliderBanner $slider_banner, FrontAbout $frontabout)
    {
        $this->setting = $settings;
        $this->util = $util;
        $this->blog = $blog;
        $this->about = $frontabout;
        $this->banner = $banner;
        $this->slider_banner = $slider_banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ecommerce.home_setting.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.home_setting.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
        $data['about_content'] = $request->about_content;
        $data['social_links'] = json_encode(array_combine($request->site, $request->sitelink));
        $data['google_map_link'] = $request->google_map_link;
        $data['created_by'] = Auth::user()->id;
        $this->setting->fill($data);
        $status = $this->setting->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Settings Added Successfully!'
            ];
            return redirect()->route('homepage-setting.index')->with('status', $output);
        }
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
        $data['about_content'] = $request->welcome_description;
        $data['social_links'] = json_encode(array_combine($request->site, $request->sitelink));
        $data['google_map_link'] = $request->google_map_link;
        $data['created_by'] = Auth::user()->id;
        $this->setting->fill($data);
        // dd($this->setting);
        $status = $this->setting->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => "Settings Updated Successfully"
            ];
            return redirect()->route('homepage-setting.index')->with('status', $output);
        }
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

    public function viewBlog()
    {
        $blogs = Blog::with('category')->orderBy('id', "desc")->paginate(4);
        return view('ecommerce.blog.index')->with('blogs', $blogs);
    }

    public function createBlog()
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('ecommerce.blog.form')->with('categories', $categories);
    }

    public function storeBlog(Request $request)
    {
      // dd($request->hasFile('banner_image'));
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category_id;
        $data['summary'] = $request->summary;
        $data['description'] = $request->description;
        if ($request->hasFile('blog_image')) {
            $data['image'] = $this->util->uploadHomeFile($request->blog_image, config('constants.product_img_path') . '/home/blogs');
       
        }
        $this->blog->fill($data);
        $status = $this->blog->save();
        // dd($status);
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Blog Added Successfuly'
            ];
            return redirect()->route('ecom_blog')->with('status', $output);
        }
    }

    public function editBlog($id)
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        $this->blog = $this->blog->where('id', $id)->first();
        return view('ecommerce.blog.edit')->with('blog_info', $this->blog)
            ->with('categories', $categories);
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog_image = $blog->image;
        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->summary = $request->summary;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->image = $request->previous_blog_image;
        if (!isset($request->previous_blog_image)) {
            if (!empty($blog_image) && file_exists(public_path() . '/uploads/img/home/blogs/' . $blog_image)) {
                unlink(public_path() . '/uploads/img/home/blogs/' . $blog_image);
            }
        }
        if ($request->hasFile('blog_image')) {
            $blog->image = $this->util->uploadHomeFile($request->blog_image[0], config('constants.product_img_path') . '/home/blogs');
            if (!empty($blog_image) && file_exists(public_path() . '/uploads/img/home/blogs/' . $blog_image)) {
                unlink(public_path() . '/uploads/img/home/blogs/' . $blog_image);
            }
        }
        $status = $blog->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Blog Updated Successfully'
            ];
            return redirect()->route('ecom_blog')->with('status', $output);
        }
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        $blog_image = $blog->image;
        if (!$blog) {
            $output = [
                'error' => 1,
                'msg' => 'Blog does not Found'
            ];
            return redirect()->route('ecom_blog')->with('status', $output);
        }
        $status = $blog->delete();
        if ($status) {
            if (!empty($blog_image) && file_exists(public_path() . '/uploads/img/home/blogs/' . $blog_image)) {
                unlink(public_path() . '/uploads/img/home/blogs/' . $blog_image);
            }
            $output = [
                'success' => 1,
                'msg' => 'Blog deleted Successfully'
            ];
            return redirect()->route('ecom_blog')->with('status', $output);
        }
    }

    public function viewBlogCat()
    {
        $categories = BlogCategory::orderBy('id', 'desc')->get();
        return view('ecommerce.blog.category_index')->with('categories', $categories);
    }

    public function storeBlogCat(Request $request)
    {
        $blog_cat = new BlogCategory();
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $blog_cat->fill($data);
        $status = $blog_cat->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Category Added Successfuly'
            ];
            return redirect()->back()->with('status', $output);
        }
    }
    
    public function editBlogCat($id)
    {

        $categories = BlogCategory::findorfail($id);
        return view('ecommerce.blog.category_form')->with($categories);


    }
   
    public function updateBlogCat(Request $request , $id)
    {
            // $data=$request->all();
            $categories=BlogCategory::find($id);
            // return $data; 
            $categories->update($data);
            return redirect()->route('ecommerce.blog.category_index');
    }
        public function deleteBlogCat($id)
        {
        $blog_cat = BlogCategory::findorfail($id);
        $blog_cat->delete();
        return back();
    }

    public function viewPages()
    {
        $pages = PageSetting::paginate();
        return view('ecommerce.pages.index')->with('pages', $pages);
    }

    public function createPages()
    {
        return view('ecommerce.pages.form');
    }

    public function storePages(Request $request)
    {
        $page = new PageSetting();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->body = $request->body;
        $page->added_by = Auth::user()->id;
        $status = $page->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Page Added Successfuly'
            ];
            return redirect()->route('cms_pages')->with('status', $output);
        }
    }

    public function editPages($id)
    {
        $page_setting = PageSetting::findOrFail($id);
        return view('ecommerce.pages.edit')->with('page_setting', $page_setting);
    }

    public function updatePages(Request $request, $id)
    {
        $page_setting = PageSetting::findOrFail($id);
        $page_setting->title = $request->title;
        $page_setting->body = $request->body;
        $page_setting->status = $request->status;
        $status = $page_setting->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Page Updated Successfuly'
            ];
            return redirect()->route('ecom_pages')->with('status', $output);
        }
    }

    public function deletePages($id)
    {
        $page_setting = PageSetting::find($id);
        if (!$page_setting) {
            $output = [
                'error' => 1,
                'msg' => 'Page does not Found'
            ];
            return redirect()->route('ecom_pages')->with('status', $output);
        }
        $status = $page_setting->delete();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Page deleted Successfuly'
            ];
            return redirect()->route('ecom_pages')->with('status', $output);
        }
    }


    //Banner Section
    public function bannerIndex()
    {
        $banners = Banner::paginate(5);
        return view('ecommerce.banner.bannerView')->with('banners', $banners);
    }

    public function createBanner()
    {
        return view('ecommerce.banner.bannerCreate');
    }

    public function storeBanner(Request $request)
    {
    //    dd($request->hasFile('banner_image'));
        if ($request->hasFile('banner_image')) {
            $data['image'] = $this->util->uploadHomeFile($request->banner_image, config('constants.product_img_path') . '/home/banners');
       
        }
        $this->banner->fill($data);
        $status = $this->banner->save();
        // dd($status);
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'banner Added Successfuly'
            ];
            return redirect()->route('banner_index')->with('status', $output);
        }
    }

    public function editBanner($id)
    {
        $banners = Banner::findOrFail($id);
        return view('ecommerce.banner.bannerEdit')->with('banners', $banners);
    }

    public function updateBanner(Request $request, $id)
    {
        $banner = banner::findOrFail($id);
        $banner_image = $banner->image;
        $banner->status = $request->status;
        $banner->image = $request->previous_banner_image;
        if (!isset($request->previous_banner_image)) {
            if (!empty($banner_image) && file_exists(public_path() . '/uploads/img/home/banners/' . $banner_image)) {
                unlink(public_path() . '/uploads/img/home/banners/' . $banner_image);
            }
        }
        if ($request->hasFile('banner_image')) {
            $banner->image = $this->util->uploadHomeFile($request->banner_image, config('constants.product_img_path') . '/home/banners');
            if (!empty($banner_image) && file_exists(public_path() . '/uploads/img/home/banners/' . $banner_image)) {
                unlink(public_path() . '/uploads/img/home/banners/' . $banner_image);
            }
        }
        $status = $banner->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'banner Updated Successfully'
            ];
            return redirect()->route('banner_index')->with('status', $output);
        }
    }

    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        $banner_image = $banner->image;
        if (!$banner) {
            $output = [
                'error' => 1,
                'msg' => 'banner does not Found'
            ];
            return redirect()->route('banner_index')->with('status', $output);
        }
        $status = $banner->delete();
        if ($status) {
            if (!empty($banner_image) && file_exists(public_path() . '/uploads/img/home/banners/' . $banner_image)) {
                unlink(public_path() . '/uploads/img/home/banners/' . $banner_image);
            }
            $output = [
                'success' => 1,
                'msg' => 'banner deleted Successfully'
            ];
            return redirect()->route('banner_index')->with('status', $output);
        }
    }



    //Slider Banner Section
    public function sliderbannerIndex()
    {
        $silder_banners = SliderBanner::paginate(5);
        return view('ecommerce.slider_banner.slider_banner_view')->with('silder_banners', $silder_banners);
    }

    public function slidercreateBanner()
    {
        return view('ecommerce.slider_banner.slider_banner_create');
    }

    public function sliderstoreBanner(Request $request)
    {
    //    dd($request->hasFile('banner_image'));
        if ($request->hasFile('slider_banner_image')) {
            $data['image'] = $this->util->uploadHomeFile($request->slider_banner_image, config('constants.product_img_path') . '/home/slider_banners');
       
        }
        $this->slider_banner->fill($data);
        $status = $this->slider_banner->save();
        // dd($status);
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'Slider Banner Added Successfuly'
            ];
            return redirect()->route('slider_banner_index')->with('status', $output);
        }
    }

    public function slidereditBanner($id)
    {
        $slider_banners = SliderBanner::findOrFail($id);
        return view('ecommerce.slider_banner.slider_banner_edit')->with('slider_banners', $slider_banners);
    }

    public function sliderupdateBanner(Request $request, $id)
    {
        $slider_banner = SliderBanner::findOrFail($id);
        $slider_banner_image = $slider_banner->image;
        $slider_banner->status = $request->status;
        $slider_banner->image = $request->previous_slider_banner_image;
        if (!isset($request->previous_slider_banner_image)) {
            if (!empty($slider_banner_image) && file_exists(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image)) {
                unlink(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image);
            }
        }
        if ($request->hasFile('slider_banner_image')) {
            $slider_banner->image = $this->util->uploadHomeFile($request->slider_banner_image, config('constants.product_img_path') . '/home/slider_banners');
            if (!empty($slider_banner_image) && file_exists(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image)) {
                unlink(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image);
            }
        }
        $status = $slider_banner->save();
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'banner Updated Successfully'
            ];
            return redirect()->route('slider_banner_index')->with('status', $output);
        }
    }

    public function sliderdeleteBanner($id)
    {
        $slider_banner = SliderBanner::find($id);
        $slider_banner_image = $slider_banner->image;
        if (!$slider_banner) {
            $output = [
                'error' => 1,
                'msg' => 'banner does not Found'
            ];
            return redirect()->route('slider_banner_index')->with('status', $output);
        }
        $status = $slider_banner->delete();
        if ($status) {
            if (!empty($slider_banner_image) && file_exists(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image)) {
                unlink(public_path() . '/uploads/img/home/slider_banners/' . $slider_banner_image);
            }
            $output = [
                'success' => 1,
                'msg' => 'banner deleted Successfully'
            ];
            return redirect()->route('slider_banner_index')->with('status', $output);
        }
    }

    //About section
    public function createAbout()
    {
        return view('ecommerce.about_form');
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
        //dd($data);
        $status = $this->about->save($data);
        if ($status) {
            $output = [
                'success' => 1,
                'msg' => 'About Settings Added Successfuly'
            ];
            return redirect()->route('ecommerce_about_edit')->with('status', $output);
        }
    }

    public function editAbout()
    {
        $data = FrontAbout::first();
        if (!$data) {
            return redirect()->route('ecommerce_about_form');
        }
        return view('ecommerce.about_edit')->with('about_info', $data);
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
            return redirect()->route('ecommerce_about_edit')->with('status', $output)
                ->with('about_info', $settings);
        }
    }
 
  
}

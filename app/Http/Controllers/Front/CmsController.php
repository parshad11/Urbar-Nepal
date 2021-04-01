<?php

namespace App\Http\Controllers\Front;

use App\Front\Blog;
use App\Front\BlogCategory;
use App\Front\HomeSetting;
use App\Front\PageSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Util;
use Illuminate\Support\Str;

use function GuzzleHttp\json_encode;

class CmsController extends Controller
{
    protected $setting;
    protected $util;
    protected $blog;

    public function __construct(HomeSetting $settings, Util $util, Blog $blog)
    {
        $this->setting = $settings;
        $this->util = $util;
        $this->blog = $blog;
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
        $data['created_by'] = $request->session()->get('user.id');
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
        $data['created_by'] = $request->session()->get('user.id');
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
        return 'blog';
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
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category_id;
        $data['summary'] = $request->summary;
        $data['description'] = $request->description;
        if ($request->hasFile('blog_image')) {
            $data['image'] = $this->util->uploadHomeFile($request->blog_image[0], config('constants.product_img_path') . '/home/blogs');
        }
        $data['added_by'] = $request->session()->get('user.id');
        $this->blog->fill($data);
        $status = $this->blog->save();
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
        $page->added_by = $request->session()->get('user.id');
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
  
}

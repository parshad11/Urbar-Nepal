@extends('ecommerce.layouts.master')
@section('content')
    <!-- MOBILE NAV START -->
    <!-- <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
      <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>
        <section class="mobile-nav">
          <form class="uk-search uk-search-default">
            <button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>
            <input class="uk-search-input" type="search" placeholder="Search...">
          </form>
          <ul class="metismenu" id="menu">
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse1">Home</a>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                  <ul class="list-group">
                  </ul>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse2">Categories</a>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <ul class="list-group ">
                    <li class="list-group-item bg-transparent border-0"></li>
                    <li class="list-group-item bg-transparent border-0"></li>
                    <li class="list-group-item bg-transparent border-0"></li>
                  </ul>
                </div>
              </div>
          </ul>
        </section>
      </div>
    </div> -->
    <!-- MOBILE NAV END -->
    <!-- END OF HEADER -->
    <!-- BLOG Single START -->
    <div class="blog-single mb-5 container">
      <div class="row">
        <div class="col-lg-9 col-md-12 post">
          <div class="link py-4">
            <ul class="d-flex">
              <li class="px-1"><a href="{{route('front_dashboard')}}">Home</a></li>/
              <li class="px-1"><a href="{{route('blog')}}">blog</a></li>/
              <li class="px-1"><a href="#">category</a></li>
            </ul>
          </div>
          <!-- <div class="blog-content">
                    <h2>{{$blog_single->title}}</h2>
                    <p>{!! $blog_single->description !!}</p>
           </div> -->
          <div class="post">
            <div class="title">
            <h2>{{$blog_single->title}}</h2>
            </div>
            <div class="img" style="height:500px; width:500px;">
            <img src="{{asset('uploads/img/home/blogs/'.$blog_single->image)}}" alt=""style="height:100%; width:100%;" >
            </div>
            <div class="detail">
            <div class="news-item">
            <p>Date::<a href="#">{{\Carbon\Carbon::parse($blog_single['created_at'])->format('M d, Y')}}</a></p>
                            </div>
              <div class=" p-2 text-justify content">
              <p>{!! $blog_single->description !!}</p>     
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-12 mt-5 border-left border-md-0 sidebar">
          <ul class="mt-5">
            <h4 class="py-1">Categories</h4>
            @if(isset($categories))
                        @foreach($categories as $category)
                        <li><a href="#">{{$category->title}}</a> 
                        <!-- <span class="pull-right">{{count($category->news)}}</span> -->
                        </li>
                        @endforeach
             @endif
          </ul>
          <ul class="mt-5">
            <h4 class="py-1">Recent Blogs</h4>
            @if(isset($categories))
                        @foreach($categories as $category)
                        <li><a href="#">{{$category->title}}</a> 
                        <!-- <span class="pull-right">{{count($category->news)}}</span> -->
                        </li>
                        @endforeach
             @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- BLOG END -->
  @endsection

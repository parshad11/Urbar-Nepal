@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('scripts')
@endsection
@section('content')
<!-- Page heading Start -->
<section class="page-heading-area overlay-black" id="water-animation">
    @if(isset($about_info))
    <img class="jarallax-img" src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
    @endif
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-heading-col border-hover">
                    <h2>Our blog</h2>
                    <p><a href="{{ route('front_dashboard') }}">Home</a> / <a href="{{route('blog')}}">blog</a></p>
                </div>
            </div>
        </div>
    </div> --}}
</section>

<!-- Blog Start -->
<section class="blog-area blog-sidebar-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @if(isset($blogs) && count($blogs) > 0)
                        @foreach($blogs as $blog)
                        <div class="col-md-6 col-sm-6">
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="{{asset('uploads/img/home/blogs/'.$blog->image)}}" alt="{{$blog->category->title}}">
                                </div>
                                <div class="blog-box-content">
                                    <ul class="post-bar">
                                        <li><a href="#">{{$blog->category->title}}</a></li>
                                        <li>{{\Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</li>
                                    </ul>
                                    <h3 class="post-title"><a href="{{ route('blog_single', $blog->slug) }}">{{$blog->title}}</a></h3>
                                    <p class="post-description">
                                        {{substr($blog->description, 0, 100)}}...
                                    </p>
                                    <a class="btn btn-default theme-btn btn-hover" href="{{ route('blog_single', $blog->slug) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    {!! $blogs->links('frontcms.pagination') !!}

                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="sidebar-search">
                            <form method="post">
                                <div class="input-group">
                                    <input placeholder="Search Here....." class="form-control" name="search-field" type="text">
                                    <span class="input-group-btn">
                                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                  </span>
                                </div>
                            </form>
                        </div>
                        <div class="categories clearfix">
                            <h3 class="sedebar-title">categories</h3>
                            <ul>
                                @if(isset($categories))
                                @foreach($categories as $category)
                                <li><a href="#">{{$category->title}}</a> <span class="pull-right">{{count($category->news)}}</span>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="latest-news">
                            <h3 class="sedebar-title">latest news</h3>
                            <ul>
                                @if(isset($blogs))
                                @foreach($blogs as $key => $blog)
                                @if($key <=2)
                                <li>
                                    <div class="news-item">
                                        <img src="{{asset('uploads/img/home/blogs/'.$blog->image)}}" alt="{{$blog->title}}">
                                        <h4><a href="{{ route('blog_single', $blog->slug) }}">{{$blog->title}}</a></h4>
                                        <p>{{\Carbon\Carbon::parse($blog->created_at)->format('d M, Y')}}</p>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        {{-- @if(isset($vido_link))
                        <div class="blog-video">
                            <h3 class="sedebar-title">Video Preview</h3>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="https://youtu.be/fD6SzYIRr4c" allowfullscreen=""></iframe>
                            </div>
                        </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
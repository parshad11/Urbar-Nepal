@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('scripts')
@endsection
@section('content')
<!-- Page heading Start -->
<section class="page-heading-area jarallax overlay-black" id="water-animation">
    <img class="jarallax-img" src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-heading-col border-hover">
                    <h2>Our blog</h2>
                    <p><a href="{{ route('front_dashboard') }}">Home</a> / <a href="{{route('blog')}}">blog</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Start -->
<section class="blog-area">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="post-box">
                    <div class="post-img">
                        <img src="{{asset('uploads/img/home/blogs/'.$blog->image)}}" alt=""  style="height: 280px!important;">
                    </div>
                    <div class="blog-box-content">
                        <ul class="post-bar">
                            {{-- <li><a href="#">Cris Alvin</a></li> --}}
                            <li><a href="javascript:;">{{\Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</a></li>
                            {{-- <li><a href="#">2 Comments</a></li> --}}
                        </ul>
                        <h3 class="post-title"><a href="{{ route('blog_single', $blog->slug) }}">{{$blog->title}}</a></h3>
                        <p class="post-description">
                            {{$blog->summary}}
                        </p>
                        <a class="btn btn-default theme-btn btn-hover" href="{{ route('blog_single', $blog->slug) }}">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <nav class="pagination-outer" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a href="#" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a href="#" class="page-link" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>
@endsection
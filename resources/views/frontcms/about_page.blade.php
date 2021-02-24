@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('content')
  <!-- Page heading Start -->
  <section class="page-heading-area jarallax overlay-black" id="water-animation">
    @if (isset($about_info->banner_image) && !empty($about_info->banner_image) && file_exists(public_path().'/uploads/img/home/about/'.$about_info->banner_image))
        {{-- <img src="{{ asset('uploads/img/home/about/'.$about_info->banner_image) }}" alt=""> --}}
        <img class="jarallax-img" src="{{ asset('uploads/img/home/about/'.$about_info->banner_image) }}" alt="">                        
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-heading-col border-hover">
                    <h2>About Us</h2>
                    <p><a href="{{ route('front_dashboard') }}">Home</a> / <a href="{{ route('front_about') }}">About</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inner About Start -->
<section class="about-inner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="about-inner-col">
                    <h2> What we do </h2>
                    @if(isset($about_info) && !null == $about_info->what_sub_title)
                        <h4>{{ $about_info->what_sub_title }}</h4>
                    @endif

                    @if(isset($about_info) && !empty($about_info->what_description))
                        <p>{!! $about_info->what_description !!}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-inner-col">
                    @if (isset($about_info->what_image) && !empty($about_info->what_image) && file_exists(public_path().'/uploads/img/home/about/'.$about_info->what_image))
                        <img src="{{ asset('uploads/img/home/about/'.$about_info->what_image) }}" alt="">                        
                    @endif
                </div>
            </div>
        </div>
        <div class="row choose-row">
            <div class="col-md-5">
                <div class="choose-col">
                    @if (isset($about_info->why_image) && !empty($about_info->why_image) && file_exists(public_path().'/uploads/img/home/about/'.$about_info->why_image))
                        <img src="{{ asset('uploads/img/home/about/'.$about_info->why_image) }}" alt="">                        
                    @endif
                    {{-- <img src="images/about/2.jpg" alt=""> --}}
                </div>
            </div>
            <div class="col-md-7">
                <div class="choose-col">
                    <h2>why choose us</h2>
                    @if(isset($about_info) && !empty($about_info->why_description))
                        <p>{!! $about_info->why_description !!}</p>
                    @endif
                    <ul>
                        @if(isset($about_info) && !empty($about_info->why_short_points))
                            @php
                                $why_lists = json_decode($about_info->why_short_points, true)
                            @endphp
                            @foreach($why_lists as $list)
                                <li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{ $list }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

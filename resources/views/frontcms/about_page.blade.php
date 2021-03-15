@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('styles')
    <style>
        .about-inner-area .about-inner-col ul li {
            list-style-type: unset !important;
        }
    </style>
@endsection
@section('content')
    <!-- Page heading Start -->
    <section class="page-heading-area overlay-black" id="water-animation">
        @if(isset($about_info))
            {{-- <img src="{{ asset('uploads/img/home/about/'.$about_info->banner_image) }}" alt=""> --}}
            <img class="jarallax-img" src="{{ asset('uploads/img/home/about/'.$about_info->banner_image) }}" alt="">
        @endif
    </section>
    {{-- About Section --}}
    <section style="padding: 50px 0;background-color:#f8f8f8;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>{!! isset($about_content) ? $about_content : '' !!}</p>
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
                        <h2>Mission and Vision</h2>

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
                        <h2>Philosophy</h2>
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

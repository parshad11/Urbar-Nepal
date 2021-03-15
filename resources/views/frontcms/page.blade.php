@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommerce platform' )
@section('scripts')
@endsection
@section('content')
    <!-- Page heading Start -->
    <section class="page-heading-area overlay-black" id="water-animation">
        @isset($about_info)
            <img class="jarallax-img"  src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
            {{--    <img class="jarallax-img"  src="{{asset('cms/images/bg/banner.jpg')}}" alt="">--}}
        @endisset
    </section>

    <!-- Faq Start -->
    <section class="faq-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {!! isset($page_info) ? $page_info->body  : '' !!}
                </div>
            </div>
        </div>
    </section>
@endsection
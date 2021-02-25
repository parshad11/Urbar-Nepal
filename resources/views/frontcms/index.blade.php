@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('scripts')
@endsection
@section('content')
<!-- Banner Start -->
<section class="slider-area jarallax overlay-black">
    @php
        $banner_images= explode(',',$home_setting->banner_images);
    @endphp
    <div id="slider" data-zs-src='[
        @if(isset($banner_images[0]))  
        "{{ asset('uploads/img/home/'.$banner_images[0]) }}"
        @endif
        ,"{{ asset('uploads/img/home/'.$banner_images[0]) }}"
        @if(isset($banner_images[1]))  
        ,"{{ asset('uploads/img/home/'.$banner_images[1]) }}"
        @endif
        @if(isset($banner_images[2])) 
        ,"{{ asset('uploads/img/home/'.$banner_images[2]) }}"
        @endif
        ]' data-zs-bullets="false" data-zs-interval="8000" data-zs-switchSpeed="800" data-zs-interval="4500" data-zs-overlay="false" data-zs-autoplay="true">
        <div class="slider-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="slider-col slider-ontext">
                            <h1>Start your business with <span>freshktm<span></h1>
                            <h3 class="cd-headline clip">
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">We are very experienced</b>
                                    <b>we are very trusted</b>
                                    <b>Be happy with us</b>
                                </span>
                            </h3>
                            <div class="slider-buttons">
                                <a class="btn btn-default theme-btn btn-hover" href="#">Shop Now</a>
                                <a class="btn btn-default theme-btn btn-hover" href="contact.html">Become a Partner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Start -->
<section class="features-area bg-shape">
    @php
        $why_text = json_decode($home_setting->why_choose_us, true);
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>why choose us</h2>
                    <div class="title-border"></div> 
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-network-locked"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Agriculture Leader</h3>
                            <p class="description">
                                {{$why_text['Agriculture Leader']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-badge-check"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Quality Standards</h3>
                            <p class="description">
                                {{$why_text['Quality Standards']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-thumb-up"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Organic Service</h3>
                            <p class="description">
                                {{$why_text['Organic Service']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Start -->
<section class="about-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-col">
                    <h2>Welcome to <span>Freshktm</span></h2>
                    <h4>More than 12 years of experience</h4>
                    <p>{{ $home_setting->welcome_description }}</p>
                    <p>Morbi scelerisque volutpat egestas. Fusce dapibus rutrum magna, id pharetra lectus consectetur quis. Nunc ut porta enim, ac vulputate nisl. Vivamus sit amet dui quis leo suscipit scelerisque. Suspendisse euismod magna nec justo aliquam, tincidunt luctus mauris ultricies.</p>
                    <a class="btn btn-default theme-btn btn-hover" href="#" role="button">Join Us</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-col">
                    <img src="{{ asset('uploads/img/home/'.$home_setting->welcome_image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section section-default jarallax overlay-black">
    <img class="jarallax-img" src="{{ asset('uploads/img/home/'.$home_setting->vdo_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="video-col">
                    <h2>Let's see a quick video</h2>
                    <a class="bla-2 hvr-ripple-out" href="{{ $home_setting->vdo_link }}">
                        <i class="fa fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Start -->
<section class="service-area bg-shape">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>our Services</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
        </div>
        <div class="row">
            @if(isset($services) && !empty($services))
                @foreach($services as $service)
                <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                    <div class="service-col">
                        <div class="service-img">
                            @if(isset($service->service_image) && !empty($service->service_image) && file_exists(public_path().'/uploads/img/home/services/'.$service->service_image))
                            <img src="{{ asset('uploads/img/home/services/'.$service->service_image)}}" alt="">
                            @endif
                        </div>
                        <div class="service-content">
                            <h3><a href="#">{{ $service->title }}</a></h3>
                            <p>{{ $service->summary }}</p>
                            <span></span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Call Start -->
<section class="call-area jarallax overlay-black">
    <img class="jarallax-img" src="{{ asset('uploads/img/home/'.$home_setting->call_section_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="call-box call-number">
                    <h1>we are ready to receive your call</h1>
                    <h2><i class="zmdi zmdi-headset-mic"></i>{{ $home_setting->phone}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Start -->
<section class="team-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">
                    <h2>Meet Our Team</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            @foreach($team_members as $team_member)
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="our-team">
                    <div class="pic">
                    @if (isset($team_member->member_image) && !empty($team_member->member_image) && file_exists(public_path().'/uploads/img/home/team/'.$team_member->member_image))
                        <img src="{{ asset('uploads/img/home/team/'.$team_member->member_image) }}" alt="">                        
                    @endif
                    </div>
                    <div class="team-content">
                        <h3 class="title"><a href="team-single.html">{{$team_member->name}}</a></h3>
                        <span class="post">{{$team_member->post}}</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-skype"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Counter Start -->
<section class="counter-area jarallax overlay-black" id="water-animation-two">
    <img class="jarallax-img" src="{{ asset('uploads/img/home/'.$home_setting->counter_section_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">2082</span>
                    </div>
                    <h3 class="title">Happy Farmers</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">1920</span>
                    </div>
                    <h3 class="title">Happy Clients</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">380</span>
                    </div>
                    <h3 class="title">our staff</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">188</span>
                    </div>
                    <h3 class="title">Win Awards</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Start -->
<section class="gallery-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">
                    <h2>Other Services</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Filter Nav -->
                {{-- <ul class="portfolio-nav">
                    <li data-filter="all"> All </li>
                    <li data-filter="1"> Delivery </li>
                    <li data-filter="2"> Pickup </li>
                    <li data-filter="3"> B2B </li>
                </ul> --}}
                <div class="filtr-container">
                    @if (isset($services))
                    @foreach($services as $service)
                    <div class="col-md-4 filtr-item" data-category="3, 2" data-sort="value">
                        <div class="box">
                            <img src="{{ asset('uploads/img/home/services/'.$service->service_image)}}" alt="">
                            <div class="box-content">
                                <h3 class="title">{{$service->title}}</h3>
                                <ul class="icon">
                                    <li>
                                        <a href="{{ asset('uploads/img/home/services/'.$service->service_image)}}" data-lightbox="lightbox" data-title="{{$service->title}}">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </li>
                                    {{-- <li><a href="#" class="fa fa-link"></a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>    
                    @endforeach                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Request Start -->
<section class="request-area jarallax overlay-black quote" id="water-animation-three">
    <img class="jarallax-img" src="{{ asset('uploads/img/home/'.$home_setting->quote_background_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="request-title">
                    <h2>Get a Quote</h2>
                </div>
               <form>
                    <div class="row">
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Your Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="email" class="form-control" id="inputEmail3" placeholder="Email Address">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Phone Numbar">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Subject">
                           </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="request-col">
                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                <button class="btn btn-default theme-btn" type="submit">Send Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="request-col">
                    <img src="{{ asset('uploads/img/home/'.$home_setting->quote_front_image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Start -->
<section class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>testimonial</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="testimonial-carousel">
                    @foreach ($testimonials as $testimonial_info)
                    <div class="testimonial">
                        <div class="pic">
                            <img src="{{asset('uploads/img/home/testimonials/'.$testimonial_info->image)}}" alt="" class="img-responsive">
                        </div>
                        <h3 class="testimonial-title">
                            {{$testimonial_info->name}}
                            <small>{{$testimonial_info->post}}</small>
                        </h3>
                        <p class="description">{{$testimonial_info->comment}}</p>
                    </div>
                    @endforeach
                </div>
            </div>   
        </div>
    </div>
</section>

<!-- Blog Start -->
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Our Blog</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            @if(isset($blogs))
            @foreach($blogs as $blog)
            <div class="col-md-6 col-sm-12">
                <div class="blog-box">
                    <div class="blog-img">
                        <img src="{{ asset('uploads/img/home/blogs/'.$blog->image)}}" alt="">
                    </div>
                    <div class="blog-box-content">
                        <h4>{{$blog->title}}</h4>
                        <div class="time-date">
                            <ul>
                                {{-- <li><i class="fa fa-user" aria-hidden="true"></i> <a href="#">Admin</a></li> --}}
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> <a href="#">{{\Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</a></li>
                                {{-- <li><i class="fa fa-comments-o" aria-hidden="true"></i> <a href="#">3 comments</a></li> --}}
                            </ul>
                        </div>
                        <p>{{ $blog->summary }}<a href="{{ route('blog_single', $blog->slug) }}">[Read More]</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Client start -->
<section class="client-area">
    @php
        $client_images= explode(',',$home_setting->client_images);
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="client-carousel">
                    @foreach ($client_images as $client_image)
                    <div class="item">
                        <a href="#"><img src="{{ asset('uploads/img/home/'.$client_image)}}" alt=""></a>
                    </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
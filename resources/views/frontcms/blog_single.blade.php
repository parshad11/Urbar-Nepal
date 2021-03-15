@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('scripts')
@endsection
@section('content')
<!-- Page heading Start -->
<section class="page-heading-area jarallax overlay-black" id="water-animation">
    @if(isset($about_info))
    <img class="jarallax-img" src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
    @endif
</section>

<!-- Blog Single Start -->
<section class="blog-area blog-sidebar-area blog-single-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-single-img">
                    <img src="{{asset('uploads/img/home/blogs/'.$blog_single->image)}}" alt="{{$blog_single->title}}">
                </div>
                <div class="time-date">
                    <ul>
                        {{-- <li><i class="fa fa-user" aria-hidden="true"></i> <a href="#">Admin</a></li> --}}
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> <a href="#">{{\Carbon\Carbon::parse($blog_single->created_at)->format('M d, Y')}}</a></li>
                        {{-- <li><i class="fa fa-comments-o" aria-hidden="true"></i> <a href="#">5 comments</a></li> --}}
                    </ul>
                </div>
                <div class="blog-content">
                    <h2>{{$blog_single->title}}</h2>
                    <p>{!! $blog_single->description !!}</p>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="comment-row">
                            <h3><a href="#">Comment(03)</a></h3>
                            <div class="comment-item">
                                <a class="pull-right" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>
                                <img src="images/blog/s1.jpg" alt="">
                                <h5>Jon Sina</h5>
                                <span>1 hours ago</span>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.</p>
                            </div>
                            <div class="comment-item middel-item">
                                <a class="pull-right" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>
                                <img src="images/blog/s2.jpg" alt="">
                                <h5>Helena Maria</h5>
                                <span>7 hours ago</span>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.</p>
                            </div>
                            <div class="comment-item">
                                <a class="pull-right" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>
                                <img src="images/blog/s3.jpg" alt="">
                                <h5>Cris Raider</h5>
                                <span>8 hours ago</span>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="row">
                    <div class="form-area">
                        <form id="contact_form" action="contact.php" method="post">
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" name="name" placeholder="Your name">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <textarea class="form-control" name="message" rows="5" placeholder="Write message here"></textarea>
                                <button class="btn btn-default theme-btn btn-hover" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>

            <div class="col-md-4">

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
                        @foreach($blogs as $blog)
                        <li>
                            <div class="news-item">
                                <img src="{{asset('uploads/img/home/blogs/'.$blog['image'])}}" alt="">
                                <h4><a href="{{ route('blog_single', $blog->slug) }}">{{$blog['title']}}</a></h4>
                                <p><a href="#">{{\Carbon\Carbon::parse($blog['created_at'])->format('M d, Y')}}</a></p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
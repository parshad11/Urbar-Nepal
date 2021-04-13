@extends('ecommerce.layouts.master')
@section('content')
<!-- About START -->


  <div class="uk-offcanvas-content">
    <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar">

            <button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>

            <section class="mobile-nav" >
                <form class="uk-search uk-search-default">
                    <button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>
                    <input class="uk-search-input" type="search" placeholder="Search...">
                </form>
                <ul class="metismenu" id="menu">
                    <li class="active" >
                        <a  href="index.html" aria-expanded="true">Home</a>
                    </li>
                    <li>
                        <a  href="category-page.html" aria-expanded="false">Electronics<span class="fa arrow"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="">Item 1</a></li>
                            <li><a href="">Item 2</a></li>
                            <li><a href="">Item 3</a></li>
                            <li><a href="">Item 4</a></li>
                            <li><a href="">Item 5</a></li>
                        </ul>
                    </li>
                    <li>
                        <a  href="category-page.html" aria-expanded="false">
                            Home Appliance<span class="fa arrow"></span>
                        </a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="">kitchen<span class="fa plus-times"></span></a>
                                <ul aria-expanded="false" class="list-levels">
                                    <li><a href="?">item 1.3.1</a></li>
                                    <li><a href="?">item 1.3.2</a></li>
                                    <li><a href="?">item 1.3.3</a></li>
                                    <li><a href="?">item 1.3.4</a></li>
                                </ul></li>
                            <li>
                                <a href="?" aria-expanded="false">bed room<span class="fa plus-times"></span></a>
                                <ul aria-expanded="false" class="list-levels">
                                    <li><a href="?">item 2.3.1</a></li>
                                    <li><a href="?">item 2.3.2</a></li>
                                    <li><a href="?">item 2.3.3</a></li>
                                    <li><a href="?">item 2.3.4</a></li>
                                </ul>
                            </li>
                            <li><a href="">terrance<span class="fa plus-times"></span></a>
                                <ul aria-expanded="false" class="list-levels">
                                    <li><a href="?">item 1.3.1</a></li>
                                    <li><a href="?">item 1.3.2</a></li>
                                    <li><a href="?">item 1.3.3</a></li>
                                    <li><a href="?">item 1.3.4</a></li>
                                </ul></li>
                            <li>
                                <a href="?" aria-expanded="false">Item 3<span class="fa plus-times"></span></a>
                                <ul aria-expanded="false" class="list-levels">
                                    <li><a href="?">item 2.3.1</a></li>
                                    <li><a href="?">item 2.3.2</a></li>
                                    <li><a href="?">item 2.3.3</a></li>
                                    <li><a href="?">item 2.3.4</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="aboutpage.html" aria-expanded="false">About us</a>
                    </li>
                    <li>
                        <a  href="contactpage.html" aria-expanded="false">Contact us</a>
                    </li>
                </ul>
            </section>
        </div>
    </div>
    <!--  category -->
    <section  id="about-about">
    <div class="container">
        <div class="card p-5 ">
    <h1 class="text-center ">- Our Mission -</h1>
    @if(isset($about_info) && !empty($about_info->what_description))
               <p>{!! $about_info->what_description !!}</p>
    @endif
    <h2 class="text-center">About</h2>
    <div class="text-justify mx-auto" style="max-width: 74rem;">
               <p>{!! $about_info->why_description !!}</p>                          
    </div>
    </div>
    </div>
    @if(isset($product_detail) && !empty($product_detail->set_featured))
               <p>{!! $product_detail->set_featured !!}</p>
    @endif
</section>
@endsection

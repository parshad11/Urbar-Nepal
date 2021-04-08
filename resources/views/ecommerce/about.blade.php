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
    <p class="text-center mb-4">To provide the most actionable app store data.</p>
    <h2 class="text-center">About</h2>
    <div class="text-justify mx-auto" style="max-width: 74rem;">
        <p class="about-m">At Apptopia, we all come to work every day because we want to solve the biggest problem in
            mobile. <b>Everyone is guessing</b>. Publishers don’t know what apps to build, how to monetize them, or even
            what to price them at. Advertisers &amp; brands don’t know where their target users are, how to reach them,
            or even how much they need to spend in order to do so. Investors aren’t sure which apps and genres are
            growing the quickest, and where users are really spending their time (and money).</p>
        <p class="about-m">Throughout the history of business, people use <b>data</b> to make more informed decisions.
            Our mission at Apptopia is to make the app economy more transparent. Today we provide the most actionable
            mobile app data &amp; insights in the industry. We want to make this data available to as many people as
            possible (not just the top 5%).</p>
    </div>
    </div>
    </div>
</section>
@endsection
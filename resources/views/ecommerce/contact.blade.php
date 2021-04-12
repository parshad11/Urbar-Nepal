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
    <section class="contact_us py-5">
    <div class="container">
        <div class="row box-shadow s">
            <div class="col-md-6">
                <div class="heading">
                    <h2>Direct Contact Us</h2>
                </div>
                <div class="contact_us-ul">
                    <ul>
                        <li>Phone: {{ isset($home_settings) ? $home_settings->phone : '' }}</li>
                        <li> Address: {{ isset($home_settings) ? $home_settings->address : ''}}</li>
                        <li>Email: {{isset($home_settings) ? $home_settings->email : ''}}</li>
                    </ul>
                </div>
                <div class="contact_us-map">
                    <iframe src="{!! isset($home_settings) ? $home_settings->google_map_link : '' !!}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

            </div>
            <div class="col-md-6  ">
                <div class="form_container ">
                    <div class="row">
                        <div class="col-sm-12 mb">
                            <div class="heading ">
                                <h2>Contact Form</h2>
                            </div>
                            <p>
                                Please send your message below. We will get back to you at the earliest!
                            </p>
                        </div>
                    </div>

                  
                    <form role="form" id="ajax-contact" method="post" action="{{action('Front\FrontendController@mailRequest')}}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">
                                    Your Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email">
                                    Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">
                                    Phone no.:</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone Number" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="name">
                                    Subject:</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject " required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="message">
                                    message:</label>
                                <textarea class="form-control" type="textarea" id="message" name="message" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button type="submit" class="uk-button view-cart">Send →</button>
                            </div>
                        </div>

                        
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; ">
                        <h3>Posted your message successfully!</h3>
                    </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; ">
                        <h3>Error</h3>
                        Sorry there was an error sending your form.

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
 
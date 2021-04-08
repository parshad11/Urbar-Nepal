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
                        <li>Phone: 720.974.7878</li>
                        <li> Toll Free: 1.877.929.7878</li>
                        <li>Email: info@choicescreening.com</li>
                    </ul>
                </div>
                <div class="contact_us-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d14133.189959106627!2d85.3355668232668!3d27.677198877423333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1snext%20near%20Koteshwor%2C%20Kathmandu%2C%20Nepal!5e0!3m2!1sen!2snp!4v1617337323779!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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

                    <form role="form" method="post" >

                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="message">
                                    Message:</label>
                                <textarea class="form-control" type="textarea" id="message" name="message"
                                          maxlength="6000"
                                          rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name">
                                    Your Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required="">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email">
                                    Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required="">
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
 
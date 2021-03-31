<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 ">

                <div class="footer_title">
                    <div class="heading">
                        <h3>Get Connected</h3>
                    </div>
                </div>



                <div class="footer_list">
                    <ul>
                        <li class="footer_list--item1"><a href="tel:01-6640123">01-6640123</a></li>
                        <li class="footer_list--item1"> <a href="#!">Kathmandu, Nepal</a></li>
                        <li class="footer_list--item1"> <a href="#!">www.urbarnepal.com</a></li>
                        <li class="footer_list--item1 d-flex align-items-center social_icons">
                            <a href="#!" uk-icon="facebook" class="facebook"></a>
                            <a href="#!" uk-icon="google-plus" class="google-plus"></a>
                            <a href="#!" uk-icon="twitter" class="twitter"></a>
                            <a href="#!" uk-icon="instagram" class="instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 ">
                <div class="footer_title">
                    <div class="heading">
                        <h3>Quick Links</h3>
                    </div>
                </div>
                <div class="footer_list">
                    <ul>
                        <li class="footer_list--item"><a href="{{ route('contact')}}">contact us</a></li>
                        <li class="footer_list--item"><a href="{{ route('front_about')}}">about us</a></li>
                        <li class="footer_list--item"><a href="#!">details</a></li>
                        <li class="footer_list--item"><a href="{{ route('faqs')}}">faq</a></li>
                    </ul>
                </div>
            </div>
            <div class=" col-md-4 col-sm-12">
                <div class="footer_title">
                    <div class="heading">
                        <h3>Get Apps</h3>
                    </div>
                </div>
                <div class="footer_list">
                    <ul>
                        <li class="footer_list--item1 app-links"> <a href="#">
                                <span><img src="{{ asset('ecom/img/playstore.png') }}" alt="Playstore Image" title="Get App On Playstore"></span>

                            </a>
                        </li>

                        <li class="footer_list--item1 app-links"><a href="#">
                                <span><img src="{{ asset('ecom/img/appstore.png') }}" alt="Appstore Image" title="Get App On Playstore"></span>

                            </a>
                        </li>
                    </ul>
                </div>

            </div>


        </div>
    </div>
</footer>
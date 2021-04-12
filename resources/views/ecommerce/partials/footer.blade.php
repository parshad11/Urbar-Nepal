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
                        <li class="footer_list--item1">
                            <a href="tel:{{isset($home_settings) ? $home_settings->phone : ''}}">
                                {{ isset($home_settings) ? $home_settings->phone : '' }}
                            </a>
                        </li>
                        <li class="footer_list--item1"> 
                            <a href="#!">
                            {{ isset($home_settings) ? $home_settings->address : ''}}
                            </a>
                        </li>
                        <li class="footer_list--item1">
                             <a href="mailto:{{isset($home_settings) ? $home_settings->email : ''}}">
                             {{isset($home_settings) ? $home_settings->email : ''}}
                            </a>
                        </li>
                        <li class="footer_list--item1 d-flex align-items-center social_icons">
                        @if(isset($home_settings) && $home_settings->social_links != null)
                                @php
                                    $result = json_decode($home_settings->social_links, true);
                                @endphp
                            <a href="{{ $result['facebook'] }}" uk-icon="facebook" class="facebook"></a>
                            <a href="{{ $result['google'] }}" uk-icon="google-plus" class="google-plus"></a>
                            <a href="{{ $result['twitter'] }}" uk-icon="twitter" class="twitter"></a>
                            <a href="{{ $result['instagram'] }}" uk-icon="instagram" class="instagram"></a>
                        @endif
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
                        <li class="footer_list--item"><a href="{{ route('front_dashboard')}}">Home</a></li>
                        <li class="footer_list--item"><a href="{{ route('contact')}}">contact us</a></li>
                        <li class="footer_list--item"><a href="{{ route('front_about')}}">about us</a></li>
                        <li class="footer_list--item"><a href="{{ route('blog')}}">blogs</a></li>
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
<!-- Header topbar start -->
<div class="header-topbar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="herader-topbar-col tobar-leftside center767">
                    <p>Welcome To Freshktm</p>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="herader-topbar-col tobar-leftside center767">
                    <p>Fresh Produce Supply Chain</p>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="herader-topbar-col tobar-rightside center767">
                    <ul>
                        @if(isset($home_settings) && $home_settings->social_links != null)
                        @php
                            $result = json_decode($home_settings->social_links, true);
                            // $social_link = explode(",",$home_settings->social_links);
                            // foreach($social_link as $key => $value){
                            //     list($k, $v) = explode('=', $value);
                            //     $result[ $k ] = $v;
                            // }
                        @endphp
                        <li><a href="{{ $result['facebook'] }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ $result['twitter'] }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{ $result['linkedin'] }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="{{ $result['google'] }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Middle -->
<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 full-wd480">
                <div class="header-middle-col main-logo">
                   <a href="{{ route('front_dashboard') }}">
                    @if(isset($home_settings))
                    <img src="{{ asset('uploads/img/home/'.$home_settings->logo_image) }}" alt="">
                    @else
                    <img src="{{ asset('img/freshktm_logo.png') }}" alt="">
                    @endif
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 full-wd480">
                <div class="header-middle-col my-info-box">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <h4>Mail</h4>
                    @if(isset($home_settings))
                    <p>{{ $home_settings->email }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 full-wd480">
                <div class="header-middle-col my-info-box">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <h4>Phone Number</h4>
                    @if(isset($home_settings))
                    <p>{{ $home_settings->phone }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 full-wd480 appstore">
                <div class="header-middle-col apps-link-main">
                    <div class="apps-link">
                        <a href="#quote" id="scroll"><img src="{{ asset('cms/images/appstore.png')}}" alt=""></a>

                        <a href="#quote" id="scroll"><img src="{{ asset('cms/images/googleplay.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
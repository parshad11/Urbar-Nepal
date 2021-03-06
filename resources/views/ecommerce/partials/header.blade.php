<header class="header" id="header">
    <!-- <div class="top-header py-1 ">
        <div class="container-fluid">
            <div class=" d-flex align-items-center justify-content-between ">
                <div class="top-header-welcome--text text-center w-75 py-1  ">
                    <h5 class="text-white">Flash Sale 2021 ! <a href="#!">20% Discount</a></h5>
                </div>
                <div class="top-header-contact d-flex align-items-center justify-content-around">
                    <div class="text-white" id="top-header-close"><i class="fas fa-times"></i></div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="mid-header " style="z-index: 1000;" uk-sticky="top: 100;  animation: uk-animation-slide-top">
        <div class="container-fluid">
            <!-- TOP HEAD SECTION    -->
            <div class="row">

                <div class="col-md-3 col-sm-12 ">
                    <div class="logo__and__user ">

                        <div class="logo">
                            <a href="#offcanvas-usage" uk-toggle="target: #offcanvas-flip" class="bars "
                                style="display: none;">
                                <i class="fas fa-bars"></i>
                            </a>
                            <a class="logo-link" href="{{ route('front_dashboard')}}">
                                @if(isset($home_settings))
                                    <img src="{{ asset('uploads/img/home/'.$home_settings->logo_image) }}"
                                            alt="">
                                @else
                                <!-- <img src="{{ asset('ecom/img/logo-main.png') }}" class="" alt="Urbar Nepal logo"> -->
                                @endif
                            </a>
                        </div>
                        <div class="mobile_screen" style="display: none">
                            <div class="users">
                                <div class="user-login">
                                    <ul class="user_login_ul">
                                        <li class="user_login_li relative">
                                        @if(Auth::guard('customer')->check())
                                            <i class="far fa-user" style="display: none"><span style="
                                            background: #f0713d;
                                            color: white;
                                            padding: 10px 15px;
                                            border-radius:5px;
                                            ">{{Auth::guard('customer')->user()->name}}</span></i>
                                            <ul class="user_login_ul sub_ul">
                                                <li class="sub_li"><a href="{{route('customer.account')}}">Account</a></li>
                                                <!-- <li class="sub_li"><a href="#">Wishlist</a></li> -->
                                                <li class="sub_li"><a href="{{route('customer.account')}}">Order</a></li>
                                                <li class="sub_li"><a href="{{Route('user.logout')}}">Logout</a></li>
                                            </ul>
                                            @else
                                            <a href="{{ route('front_login')}}" class="user-login-link">
                                                <span>Login & SignUp</span>
                                                <i class="far fa-user" style="display: none"></i>
                                            </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-cart">
                                    <a href="{{route('product.cart')}}" class="user-cart-link">

                                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/shop-cart-5-664052.png"
                                            alt="">
                                            @auth('customer')
                                                <span class="user-cart-link_no" id="mobile_cart_count">0</span>
                                            @endauth
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 ">



                <!-- SEARCH BOX -->
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" id="searchTextLg"
                                   placeholder="Search ...."
                                   aria-describedby="basic-addon2">

                            <span class="input-group-addon btn btn-success" id="basic-addon2">Search &nbsp;<i
                                        class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                    </div>
                <!-- 
                    <div class="search-box">
                        <div class="uk-margin">
                            <form class="uk-search uk-search-default ">
                                <span class="uk-search-icon-flip" uk-search-icon></span>
                                <input class="uk-search-input w-100" type="text" name="query" id="searchTextLg" placeholder="Search...">
                            </form>
                        </div>
                    </div> -->
                    
                </div>
                <div class="col-md-3">
                    <div class="users big-screen">
                        <div class="user-login">
                            <ul class="user_login_ul">
                                <li class="user_login_li relative">

                                @if(Auth::guard('customer')->check())
                               <div class='text-center pt-3'> <span class='text-center w-100'><i class="fas fa-user-alt"></i></span>
                                    <br>
                                     <span> {{Auth::guard('customer')->user()->name}} </span>                          
                                </div>
                                     <ul class="user_login_ul sub_ul">
                                        <li class="sub_li"><a href="{{route('customer.account')}}">Account</a></li>
                                        <!-- <li class="sub_li"><a href="account.html">Wishlist</a></li> -->
                                        <li class="sub_li"><a href="{{route('customer.account')}}">Order</a></li>
                                        <li class="sub_li"><a href=" {{Route('user.logout')}} ">Logout</a></li>
                                    </ul>
                                @else
                                <a href="{{ Route('front_login')}}" class="user-login-link ">
                                        <span style="
                                        background: #e6191b;
                                        color: white;
                                        padding: 10px;
                                        ">Login &amp; SignUp</span>
                                    </a>
                                @endif
                                </li>
                            </ul>

                        </div>

                        <div class="user-cart">
                            <a href="{{route('product.cart')}}" class="user-cart-link">
                                <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/shop-cart-5-664052.png"
                                    alt="">
                                    @auth('customer')
                                        <span class="user-cart-link_no" id="cart_count">0</span>
                                    @endauth
                            </a>
                            
                                <div class="user_cart_dd">
                                        @if(isset($cart_items) && count($cart_items)>0)
                                        @php
                                            $total_sum = 0;
                                        @endphp
                                        @foreach ($cart_items as $key=>$item)
                                        @php
                                            $total_sum = $total_sum + $item['total_price'];
                                        @endphp
                                            <ul class="user_cart_ul">

                                                <li>
                                                    <figure style="float: left; margin-right: 10px; width: 50px;"><img
                                                            src="@foreach($item->variation->media as $media){{ $media->display_url }}@endforeach"
                                                            alt=""></figure>
                                                    <p class="text-left">
                                                        <span> 
                                                            {{$item->variation->product->name}}&nbsp;{{$item->variation->name != "DUMMY" ? $item->variation->name : ''}}
                                                        </span><br>
                                                        <span>1</span> <span>*</span> <span>
                                                        {{ number_format($item->total_price,2) }}
                                                        </span>

                                                    </p>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                </li>

                                            </ul>
                                    @endforeach
                                    <div class="cart_subtotal">
                                        <div class="float-left">Subtotal</div>
                                        <div class="float-right"><span class=""><span
                                                    class="">Rs.</span>{{ number_format($total_sum,2) }}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    @else
                                        <h4>No items left in cart</h4>
                                    @endif
                                    <a href="{{route('product.cart')}}" class="btn  btn-default view-cart float-left">View
                                        Cart</a>
                                        
                                    <a href="{{route('product.checkout')}}"
                                        class="btn btn-danger checkout float-right">Checkout</a>
                                    <div class="clearfix"></div>
                                </div>
                        </div>


                    </div>

                    <!-- <div class="phone-header text-center pt-4">
                        <a href="#">
                            <span class="block">
                                <i class="fas fa-phone-alt"></i> &nbsp;<span class="items" dir="ltr">
                                    @if(isset($home_settings))
                                    {{ $home_settings->phone }}
                                    @endif
                                </span>
                            </span>
                        </a>
                    </div> -->
                </div>
            </div>

            </div>
            <div class="clearfix"></div>
        </div>

        <div class="bottom-header ">
            <div class="container">
                <div class="row">
                    <div class="nav-category">
                        <a href="{{Route('show_all_category')}}" uk-toggle class="	">
                            <i class="fas fa-tasks mr-2"></i><span>Categories</span>
                        </a>
                        <a href="allcategory.html" class="pl-3"> All category</a>

                    </div>
                    <ul class="nav-list-items d-flex">
                        <li><a href="{{ route('front_dashboard')}}">Home</a></li>
                        <li><a href="{{ route('front_about')}}">About us</a></li>
                        <li><a href="{{ route('contact')}}">Contact us</a></li>
                        <li><a href="{{ route('blog')}}">Blogs</a></li>
                    </ul>
                </div>
            </div>

        </div>
</header>

<!-- MOBILE NAV START -->
<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>

        <section class="mobile-nav">
            <form class="uk-search uk-search-default">
                <button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>
                <input class="uk-search-input" type="text" name="query" id="mobileSearchText" placeholder="Search...">
            </form>
            <ul class="metismenu" id="menu">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('front_dashboard')}}">Home</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('show_all_category')}}">Catelogies</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('front_about')}}">About us</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('contact')}}">Contact us</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('blog')}}">Blogs</a>
                        </div>
                    </div>
                    

            </ul>
        </section>
    </div>
</div>

<!-- MOBILE NAV END -->

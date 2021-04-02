<header class="header" id="header">
    <div class="top-header py-1 ">
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


    </div>
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
                                <img src="{{ asset('ecom/img/logo-main.png') }}" class="" alt="Urbar Nepal logo">
                            </a>

                        </div>
                        <div class="mobile_screen" style="display: none">
                            <div class="users">
                                <div class="user-login">
                                    <ul class="user_login_ul">
                                        <li class="user_login_li relative">
                                            <a href="{{ route('front_login')}}" class="user-login-link">
                                                <span>Login & SignUp</span>
                                                <i class="far fa-user" style="display: none"></i>
                                            </a>
                                            <ul class="user_login_ul sub_ul">
                                                <li class="sub_li"><a href="#">Account</a></li>
                                                <li class="sub_li"><a href="#">Wishlist</a></li>
                                                <li class="sub_li"><a href="#">Order</a></li>
                                                <li class="sub_li"><a href="#">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-cart">
                                    <a href="" class="user-cart-link">

                                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/shop-cart-5-664052.png"
                                            alt="">
                                        <span class="user-cart-link_no">1</span>
                                    </a>
                                    <div class="user_cart_dd">
                                        <ul class="user_cart_ul">
                                            <li>
                                                <figure style="float: left; margin-right: 10px; width: 50px;">
                                                    <img src="http://stat.homeshop18.com/homeshop18/images/productImages/81/lava-a67-dual-sim-android-mobile-phone-medium_3a86d70832ad27694f49cea1aba8dd81.jpg"
                                                        alt="">
                                                </figure>
                                                <p class="text-left">
                                                    <span> Name of PRoduct that is in the cart</span><br>
                                                    <span>1</span> <span>*</span> <span>2000</span>

                                                </p>
                                                <div class="clearfix"></div>
                                                <hr>
                                            </li>
                                            <li>
                                                <figure style="float: left; margin-right: 10px; width: 50px;">
                                                    <img src="http://stat.homeshop18.com/homeshop18/images/productImages/81/lava-a67-dual-sim-android-mobile-phone-medium_3a86d70832ad27694f49cea1aba8dd81.jpg"
                                                        alt="">
                                                </figure>
                                                <p class="text-left">
                                                    <span> Name of PRoduct</span><br>
                                                    <span>1</span> <span>*</span> <span>2000</span>

                                                </p>
                                                <div class="clearfix"></div>
                                                <hr>
                                            </li>

                                        </ul>
                                        <div class="cart_subtotal">
                                            <div class="float-left">Subtotal</div>
                                            <div class="float-right"><span class=""><span
                                                        class="">Rs.</span>38.00</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        <a href="cartpage.html" class="uk-button view-cart float-left">View
                                            Cart</a>
                                        <a href="checkoutpage.html"
                                            class="uk-button checkout float-right">Checkout</a>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="search-box">
                        <div class="uk-margin">
                            <form class="uk-search uk-search-default ">
                                <span class="uk-search-icon-flip" uk-search-icon></span>
                                <input class="uk-search-input" type="search" placeholder="Search...">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="users big-screen">
                        <div class="user-login">
                            <ul class="user_login_ul">
                                <li class="user_login_li relative">
                                @if(Auth::guard('customer')->check())
                                     {{Auth::guard('customer')->user()->name}}
                                     <ul class="user_login_ul sub_ul">
                                        <li class="sub_li"><a href="account.html">Account</a></li>
                                        <li class="sub_li"><a href="account.html">Wishlist</a></li>
                                        <li class="sub_li"><a href="account.html">Order</a></li>
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
                            <a href="" class="user-cart-link">

                                <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/shop-cart-5-664052.png"
                                    alt="">
                                <span class="user-cart-link_no">1</span>
                            </a>
                            <div class="user_cart_dd">
                                <ul class="user_cart_ul">

                                    <li>
                                        <figure style="float: left; margin-right: 10px; width: 50px;"><img
                                                src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                                alt=""></figure>
                                        <p class="text-left">
                                            <span> Name of PRoduct that is in the cart</span><br>
                                            <span>1</span> <span>*</span> <span>2000</span>

                                        </p>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </li>
                                    <li>
                                        <figure style="float: left; margin-right: 10px; width: 50px;"><img
                                                src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                                alt=""></figure>
                                        <p class="text-left">
                                            <span> Name of PRoduct</span><br>
                                            <span>1</span> <span>*</span> <span>2000</span>

                                        </p>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </li>

                                </ul>
                                <div class="cart_subtotal">
                                    <div class="float-left">Subtotal</div>
                                    <div class="float-right"><span class=""><span
                                                class="">Rs.</span>38.00</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                </div>
                                <a href="cartpage.html" class="btn  btn-default view-cart float-left">View
                                    Cart</a>
                                <a href="checkoutpage.html"
                                    class="btn btn-danger checkout float-right">Checkout</a>
                                <div class="clearfix"></div>
                            </div>

                        </div>


                    </div>

                    <div class="phone-header text-center pt-4">
                        <a href="#">
                            <span class="block">
                                <i class="fas fa-phone-alt"></i> &nbsp;<span class="items" dir="ltr">+977
                                    9808666456</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="bottom-header ">
        <div class="container">
            <div class="row">
                <div class="nav-category">
                    <a href="allcategory.html" uk-toggle class="	">
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
                <input class="uk-search-input" type="search" placeholder="Search...">
            </form>
            <ul class="metismenu" id="menu">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#collapse1">Home</a>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <ul class="list-group">

                            </ul>
                        </div>


                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#collapse2">Categories</a>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <ul class="list-group ">
                                <li class="list-group-item bg-transparent border-0">One</li>
                                <li class="list-group-item bg-transparent border-0">Two</li>
                                <li class="list-group-item bg-transparent border-0">Three</li>
                            </ul>
                        </div>
                    </div>
            </ul>
        </section>
    </div>
</div>

<!-- MOBILE NAV END -->
@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('styles')

{{-- <link href="https://fonts.googleapis.com/css?family=Karla|Rubik" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('/ecom/app.min.css') }}">

@endsection
@section('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.16/js/uikit.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.16/js/uikit-icons.min.js"></script>

<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
<!-- Owl carousel -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
<!-- metis menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script> --}}
<!-- custom scroll -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="{{ asset('/ecom/app.min.js') }}"></script>
 
@endsection
@section('content')
 
<section id="mega-nav--slider">
    <div class="container" >
        <div class="row">
            <div class=" col-lg-2 col-md-2 col-sm-12  side-navbar-menu">
                <div class="side-nav-category">
                    <ul class="side-nav-category-ul">
                        @foreach($categories as $category)
                        <li class="li-has-children"><a href="">{{ $category->name }}<span  class="float-right" uk-icon="icon: chevron-right"></span> <span class="clearfix"></span></a>
                            @if(count($category->sub_categories)>0)
                                <div class="hover-side-menu">
                                    <div class="sub-category-block">
                                        {{-- <div class="sub-nav-main-category"><a href=""> Beauty</a></div> --}}
                                        <ul class="side-sub-nav-category-ul">
    
                                            @foreach($category->sub_categories as $sub_category)
                                            <li class="sub-nav-li"><a href=""> {{ $sub_category->name }}</a></li>
                                            @endforeach
    
                                        </ul>
                                    </div>
                                </div>
                                @endif
                        </li>
                        @endforeach
                        <li class="li-has-children"><a href="allcategory-page.html"> <i class="fas fa-plus-square"></i>
                                All Category</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12" style="padding: 0">
                <div class="main-slider">
                        <div class="banner owl-carousel owl-theme ">

                            <div class="slider-images"><img
                                        src="https://s3.ap-south-1.amazonaws.com/mmimage/banners/September-Banners-05.jpg" alt="gadgets" width="100%" height="100%">

                            </div>
                            <div class="slider-images"><img
                                        src="https://3.bp.blogspot.com/-5mhe51fDMnI/WrkNVqm3FzI/AAAAAAAAA6k/m7_ciN6sgr8P47tUFqhkCcQAEcjORqPggCEwYBhgL/s1600/s9%2Bsprint.jpg"
                                        alt="gadgets" width="100%" height="100%">


                            </div>
                            <div class="slider-images"><img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSexpXrR_a19fh98sxRxvgltGde33338u1SIbrPpYqZFjEY_qd3"
                                        alt="gadgets" width="100%" height="100%">

                            </div>


                        </div>


                    </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-12 d-md-block d-sm-none d-none"  style="padding: 0">
             <div class="banner-right-side ">
                 
                 <img src="https://nas.com.np/storage/settings/tDRv1Ptf0dyaFyzfvU3tKFB9Usk9db3q5ASc9ADJ.png" alt="">

             </div>
            </div>
        </div>
    </div>
</section>


<section class="product-grid dealofday">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="product-grid-content">
                    
                    <div class="heading countdown">
                        <h5 ><span class="animated infinite  flash slower ">Deal of the day</span></h5>
                        <p>Don't Miss out! Ends in</p>
                        <div id="the-final-countdown">
                            <ul class="liststyle--none">
                                
                                <li><span id="hours"></span></li>:
                                <li><span id="minutes"></span></li>:
                                <li><span id="seconds"></span></li>
                            </ul>
                        </div>
                    </div>
                    <a href="categorypage.html" class="uk-button view-cart">view more</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="product-category white-product">
                    <div class="containers">
                        <div class="owl-carousel dealofday-carousel inner-column">
                            @foreach ($products as $product)
                            <article class="product instock sale purchasable" >
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>
                                        <figure>
                                            <a href="{{ route('product_single', $product->id) }}">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                         src="{{asset('uploads/img/'.$product->image)}}"
                                                         class="attachment-shop_catalog size-shop_catalog" alt="">
                                                </div>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="{{ route('product_single', $product->id) }}">{{ $product->name }}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                         <div class="product_price">
                                             <div class="product_price-actual">
                                                {{$product->variations[0]->default_sell_price}}
                                             </div>
                                             {{-- <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                 <span>-20%</span>
                                             </div> --}}
                                         </div>
                                            <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</section>

<section id="popular-category">
    <div class="container-fluid">
        <h3> Popular Categories</h3>
        <nav class=" popular-category-tabs">
            <ul class="nav nav-pills " id="nav-tab" >

                <li>  <a class="nav-item nav-link active"  data-toggle="tab" href="#nav-Desktops" >Desktops</a></li>
                <li> <a class="nav-item nav-link"  data-toggle="tab" href="#nav-Mobiles" >Mobiles</a></li>
                <li > <a class="nav-item nav-link "  data-toggle="tab" href="#nav-Laptops" >Laptops</a></li>
            </ul>
        </nav>
        <div class="tab-content popular-category" id="nav-tabContent">

            <div class="tab-pane fade" id="nav-Desktops" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://cf2.s3.souqcdn.com/item/2016/12/14/12/01/99/12/item_XL_12019912_18013925.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://www.dhresource.com/0x0s/f2-albu-g5-M00-FB-A1-rBVaI1jaBsyASTsMAASv93iI80k903.jpg/ta-nabilir-mini-led-bluetooth-hoparl-r-kablosuz.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://i.pinimg.com/474x/a6/d4/28/a6d428e72846103275824c0031e5f43d--dress-vest-vest-coat.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">hot</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-Mobiles" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://cf2.s3.souqcdn.com/item/2016/12/14/12/01/99/12/item_XL_12019912_18013925.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://www.dhresource.com/0x0s/f2-albu-g5-M00-FB-A1-rBVaI1jaBsyASTsMAASv93iI80k903.jpg/ta-nabilir-mini-led-bluetooth-hoparl-r-kablosuz.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://i.pinimg.com/474x/a6/d4/28/a6d428e72846103275824c0031e5f43d--dress-vest-vest-coat.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">hot</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>



                    </div>
                </div>
            </div>
            <div class="tab-pane  active" id="nav-Laptops" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="product-category white-product">
                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://cf2.s3.souqcdn.com/item/2016/12/14/12/01/99/12/item_XL_12019912_18013925.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://www.dhresource.com/0x0s/f2-albu-g5-M00-FB-A1-rBVaI1jaBsyASTsMAASv93iI80k903.jpg/ta-nabilir-mini-led-bluetooth-hoparl-r-kablosuz.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://i.pinimg.com/474x/a6/d4/28/a6d428e72846103275824c0031e5f43d--dress-vest-vest-coat.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">hot</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<section class="three-columns mb">

    <div class="container-fluid">
        <div class="row col-three owl-carousel">
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/titan-watch.jpg" alt=""></a>
            </div>
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/32.png" alt=""></a>
            </div>

            <div class="column">
                <a href=""><img src="https://thulo.com/images/promo/119/samsung.jpg" alt=""></a>
            </div>
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/banners-01.jpg" alt=""></a>
            </div>

        </div>
    </div>
</section>
<section id="popular-category">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <div class="heading">
                <h3> Featured Product</h3>
            </div>
            <div ><a href="category.html" class=" uk-button view-cart">view more</a></div>
        </div>
        <hr>
          <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://cf2.s3.souqcdn.com/item/2016/12/14/12/01/99/12/item_XL_12019912_18013925.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://www.dhresource.com/0x0s/f2-albu-g5-M00-FB-A1-rBVaI1jaBsyASTsMAASv93iI80k903.jpg/ta-nabilir-mini-led-bluetooth-hoparl-r-kablosuz.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://i.pinimg.com/474x/a6/d4/28/a6d428e72846103275824c0031e5f43d--dress-vest-vest-coat.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">hot</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>


                    </div>
                </div>


    </div>


</section>

<section id="popular-category">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <div class="heading">
                <h3> Featured Product</h3>
            </div>
            <div ><a href="category.html" class=" uk-button view-cart">view more</a></div>
        </div>
        <hr>
          <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://cf2.s3.souqcdn.com/item/2016/12/14/12/01/99/12/item_XL_12019912_18013925.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://www.dhresource.com/0x0s/f2-albu-g5-M00-FB-A1-rBVaI1jaBsyASTsMAASv93iI80k903.jpg/ta-nabilir-mini-led-bluetooth-hoparl-r-kablosuz.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://i.pinimg.com/474x/a6/d4/28/a6d428e72846103275824c0031e5f43d--dress-vest-vest-coat.jpg"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">hot</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <article class="product instock sale purchasable" >
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">sale</span>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <figure>
                                        <a href="">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                     src="https://wp.xpeedstudio.com/marketo/wp-content/uploads/2018/05/24-180x134.png"
                                                     class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>
                                    

                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.2000
                                            </div>
                                            <div class="product_price-discount">
                                                 <span class="line-through">
                                                     Rs.2500
                                                 </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)" > <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon></a></div>
                                    </div>

                                </div>
                            </div>
                        </article>


                    </div>
                </div>


    </div>


</section>

    <section class="three-columns mb">

    <div class="container-fluid">
        <div class="row col-three owl-carousel">
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/titan-watch.jpg" alt=""></a>
            </div>
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/32.png" alt=""></a>
            </div>

            <div class="column">
                <a href=""><img src="https://thulo.com/images/promo/119/samsung.jpg" alt=""></a>
            </div>
            <div class="column">
                <a href=""><img src="https://www.raramart.com/assets/uploads/banners-01.jpg" alt=""></a>
            </div>

        </div>
    </div>
</section>

 
@endsection

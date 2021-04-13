@extends('ecommerce.layouts.master')
@section('content')
<?php
?>
<section id="mega-nav--slider">
    <div class="slider">
        <div class="row">
            <div class=" col-lg-2 col-md-2 col-sm-12  side-navbar-menu pl-4">
                <div class="side-nav-category">
                    <ul class="side-nav-category-ul">
                    @if(isset($category))
                    @foreach($category as $category)
                        <li class="li-has-children"><a href="{{route('categories_product_list',['idd' => $category->id, 'slugg' => $category->slug])}}">{{$category->name}}<span class="float-right"
                                    uk-icon="icon: chevron-right"></span> <span class="clearfix"></span></a>
                            <div class="hover-side-menu">
                                <div class="sub-category-block">
                                    <div class="sub-nav-main-category"><a href="{{route('categories_product_list',['idd' => $category->id, 'slugg' => $category->slug])}}">{{$category->name}}</a>

                                    </div>
                                    @foreach ($sub_category as $subcategory)
                            @if ( $subcategory->parent_id == $category->id )
                                    <ul class="side-sub-nav-category-ul">

                                        <li class="sub-nav-li"><a href="{{route('product_sub_category', ['id' => $subcategory->id ,'slug' => $subcategory->slug])}}"> {{$subcategory->name}}</a></li>


                                    </ul>
                                    @endif
                               @endforeach
                                </div>

                            </div>
                        </li>
                        @endforeach
                    @endif
                        <li class="li-has-children"><a href="{{Route('show_all_category')}}"> <i
                                    class="fas fa-plus-square"></i>
                                All Category</a></li>
                    </ul>

                </div>

            </div>
            <div class="col-lg-10 col-md-12 col-sm-12" style="padding: 0">
                <div class="main-slider">
                    <div class="banner owl-carousel owl-theme ">

                    
                        @if(isset($banners))
                            @foreach($banners as $banner)
                            <div class="slider-images">
                                <img src="{{ asset('uploads/img/home/banners/'.$banner->image) }}">
                            </div>  
                            @endforeach

                        @endif

                

                    </div>


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
                        <h5><span class="animated infinite  flash slower ">Deal of the day</span></h5>
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
                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>



                                        <figure>
                                            <a href="singlepage.html">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                        src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                                        class="attachment-shop_catalog size-shop_catalog"
                                                        alt="">
                                                </div>
                                            </a>
                                        </figure>


                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="singlepage.html">Kurilo || Muthha</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product_price">
                                                <div class="product_price-actual">
                                                    Rs.200
                                                </div>
                                                <div class="product_price-discount">
                                                    <span class="line-through">
                                                        Rs.250
                                                    </span>
                                                    <span>-20%</span>
                                                </div>
                                            </div>
                                            <div class="product_cart">
                                                <a href="javascript:void(0)">
                                                    <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>








                                        <figure>
                                            <a href="singlepage.html">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                        src="https://i.ndtvimg.com/mt/cooks/2014-11/lemon.jpg"
                                                        class="attachment-shop_catalog size-shop_catalog"
                                                        alt="">
                                                </div>
                                            </a>
                                        </figure>


                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="singlepage.html">Kurilo || Muthha</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product_price">
                                                <div class="product_price-actual">
                                                    Rs.200
                                                </div>
                                                <div class="product_price-discount">
                                                    <span class="line-through">
                                                        Rs.250
                                                    </span>
                                                    <span>-20%</span>
                                                </div>
                                            </div>
                                            <div class="product_cart">
                                                <a href="javascript:void(0)">
                                                    <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>








                                        <figure>
                                            <a href="singlepage.html">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                        src="https://yenkii.com/storage/menu/3679/5ee5d65365b14.jpg"
                                                        class="attachment-shop_catalog size-shop_catalog"
                                                        alt="">
                                                </div>
                                            </a>
                                        </figure>


                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="singlepage.html">Kurilo || Muthha</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product_price">
                                                <div class="product_price-actual">
                                                    Rs.200
                                                </div>
                                                <div class="product_price-discount">
                                                    <span class="line-through">
                                                        Rs.250
                                                    </span>
                                                    <span>-20%</span>
                                                </div>
                                            </div>
                                            <div class="product_cart">
                                                <a href="javascript:void(0)">
                                                    <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</section>


<!-- POPULAR PRODUCTS -->
<section id="popular-category">
    <div class="container-fluid">
        <h3> Popular Categories</h3>
        <span class="w-100">
            <hr class="title-underline mx-auto">
        </span>
        <nav class=" popular-category-tabs">
            <ul class="nav nav-pills " id="nav-tab">

                <li> <a class="nav-item nav-link active" data-toggle="tab" href="#nav-seasonal">Seasonal</a>
                </li>
                <li> <a class="nav-item nav-link" data-toggle="tab" href="#nav-alltime">All Time</a></li>
                <li> <a class="nav-item nav-link " data-toggle="tab" href="#nav-green">Green</a></li>
            </ul>
        </nav>
        <div class="tab-content popular-category" id="nav-tabContent">

            <div class="tab-pane active fade show" id="nav-seasonal" role="tabpanel"
                aria-labelledby="nav-profile-tab">
                <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>


                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://cdn.shopify.com/s/files/1/0108/7370/0415/products/Shop-1.png"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Water Melon || Per KG</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.50
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.70
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://post.healthline.com/wp-content/uploads/2020/09/benefits-of-kale-732x549-thumbnail-732x549.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Gree Veggies || Per KG</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.100
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.120
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>


                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>








                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://i.ndtvimg.com/mt/cooks/2014-11/lemon.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Kurilo || Muthha</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.200
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.250
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>








                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://yenkii.com/storage/menu/3679/5ee5d65365b14.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Kurilo || Muthha</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.200
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.250
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>






                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-alltime" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="product-category white-product">

                    <div class="category--slider owl-carousel ">
                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>


                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://cdn.shopify.com/s/files/1/0108/7370/0415/products/Shop-4.png"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Hen EGG || Per Caret</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.380
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.400
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>


                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://m.economictimes.com/thumb/height-450,width-600,imgsize-111140,msid-72862126/potato-getty.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">White Potato || Per KG</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.150
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.180
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>



                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-green" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="product-category white-product">
                    <div class="category--slider owl-carousel ">

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>
                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://post.healthline.com/wp-content/uploads/2020/09/benefits-of-kale-732x549-thumbnail-732x549.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Gree Veggies || Per KG</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.100
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.120
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>


                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>








                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://i.ndtvimg.com/mt/cooks/2014-11/lemon.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Kurilo || Muthha</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.200
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.250
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="product instock sale purchasable">
                            <div class="product-wrap">
                                <div class="product-top">
                                    <span class="product-label discount">new</span>








                                    <figure>
                                        <a href="singlepage.html">
                                            <div class="product-image">
                                                <img width="320" height="320"
                                                    src="https://yenkii.com/storage/menu/3679/5ee5d65365b14.jpg"
                                                    class="attachment-shop_catalog size-shop_catalog" alt="">
                                            </div>
                                        </a>
                                    </figure>


                                </div>
                                <div class="product-description">

                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <p class="product-title">
                                                <a href="singlepage.html">Kurilo || Muthha</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="product_price">
                                            <div class="product_price-actual">
                                                Rs.200
                                            </div>
                                            <div class="product_price-discount">
                                                <span class="line-through">
                                                    Rs.250
                                                </span>
                                                <span>-20%</span>
                                            </div>
                                        </div>
                                        <div class="product_cart">
                                            <a href="javascript:void(0)">
                                                <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>


                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 text-right align-items-center justify-content-between">

            <div><a href="category.html" class="m-2 uk-button view-cart">view more</a></div>
        </div>
    </div>


</section>
<!-- END OF POPULAR PRODUCTS -->

    <!-- BRANDS WITH US -->
    <section class="three-columns mb">

        <div class="container-fluid">
            <div class="row col-three owl-carousel">
                @foreach($slider_banners as $slider_banner)
                <div class="column">
                    <a href="">
                    <img src="{{ asset('uploads/img/home/slider_banners/'.$slider_banner->image) }}"alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- END OF BRAND WITH US -->




 <!--FEATURED PRODUCTS-->
 <section id="popular-category">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between ">
            <div class="heading w-100">
                <h3> Featured Products</h3>
                <span class="w-100">
                    <hr class="title-underline border-0 mx-auto">
                </span>
            </div>
        </div>
        <hr>
        <div class="product-category white-product">
            <div class="category--slider owl-carousel ">
                @forelse($featured_products as $product)
                    @foreach ($product->product_variations as $product_variation)
                        @foreach ($product_variation->variations as $featured)
                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>
                                        <figure>
                                            <a href="{{route('product_single',$featured->sub_sku)}}">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                        src="@foreach($featured->media as $media){{ $media->display_url }}@endforeach"
                                                        class="attachment-shop_catalog size-shop_catalog" alt="">
                                                </div>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="singlepage.html">{{$featured->product->name}} 
                                                            &nbsp;{{$featured->name != "DUMMY" ? $featured->name : ''}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product_price">
                                                <div class="product_price-actual">
                                                    Rs. {{ number_format($featured->sell_price_inc_tax,2) }}
                                                        /{{$featured->product->unit->short_name}}
                                                </div>
                                            @if($featured->market_price>0)
                                                <div class="product_price-discount">
                                                    <span class="line-through">
                                                        Rs. {{ number_format($featured->market_price,2) }}
                                                    </span>
                                                    <!-- <span>-20%</span> -->
                                                </div>
                                            @endif
                                            </div>
                                            <div class="product_cart">
                                                <a href="javascript:void(0)">
                                                    <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                    @empty
                @endforelse


                


            </div>
        </div>

        <div class="w-100 text-right align-items-center justify-content-between">

            <div><a href="{{route('feature_product')}}" class="m-2 uk-button view-cart">view more</a></div>
        </div>


    </div>


</section>
<!--End of Featured Product-->



<!--latest category-->
<section id="popular-category">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between ">
            <div class="heading w-100">
                <h3> Latest Products</h3>
                <span class="w-100">
                    <hr class="title-underline border-0 mx-auto">
                </span>
            </div>
        </div>
        <hr>
        <div class="product-category white-product">

            <div class="category--slider owl-carousel ">
                @forelse($products as $product)
                    @foreach ($product->product_variations as $product_variation)
                        @foreach ($product_variation->variations as $variation)
                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
                                    <div class="product-top">
                                        <span class="product-label discount">new</span>
                                        <figure>
                                            <a href="{{route('product_single',$variation->sub_sku)}}">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                        src="@foreach($variation->media as $media){{ $media->display_url }}@endforeach"
                                                        class="attachment-shop_catalog size-shop_catalog" alt="">
                                                </div>
                                            </a>
                                        </figure>


                                    </div>
                                    <div class="product-description">

                                        <div class="product-meta">
                                            <div class="title-wrap">
                                                <p class="product-title">
                                                    <a href="{{route('product_single',$variation->sub_sku)}}">{{$variation->product->name}}
                                                            &nbsp;{{$variation->name != "DUMMY" ? $variation->name : ''}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product_price">
                                                <div class="product_price-actual">
                                                    Rs. {{ number_format($variation->sell_price_inc_tax,2) }}
                                                        /{{$variation->product->unit->short_name}}
                                                </div>
                                            @if($variation->market_price>0)
                                                <div class="product_price-discount">
                                                    <span class="line-through">
                                                        Rs. {{ number_format($variation->market_price,2) }}
                                                    </span>
                                                    <!-- <span>-20%</span> -->
                                                </div>
                                            @endif
                                            </div>
                                            <div class="product_cart">
                                                <a href="javascript:void(0)" id="add_to_carts" product_id="{{$variation->id}}">
                                                    <ion-icon name="cart" uk-tooltip=" Add to Cart"></ion-icon>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                    @empty
                @endforelse

            </div>
        </div>

        <div class="w-100 text-right align-items-center justify-content-between">

            <div><a href="{{route('latest_product')}}" class="m-2 uk-button view-cart">view more</a></div>
        </div>


    </div>


</section>

<!--End of Popular category-->


@endsection
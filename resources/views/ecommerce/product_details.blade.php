@extends('ecommerce.layouts.master')
@section('content')

<div class="uk-offcanvas-content">
        <!-- header -->
        <!-- End header -->
        

        <!-- MOBILE NAV START -->
        <!-- <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
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
        </div> -->

        <!-- MOBILE NAV END -->
        <!-- END OF HEADER -->
        <!--  single page -->


        <section id="single_page">
            <div class="container">
                <section class="breadcrumbs ">
                    <ul class="uk-breadcrumb">
                        <li><a href="{{ route('front_dashboard') }}">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#!">{{ $variation->product->name }}</a></li>
                    </ul>
                </section>
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <div class="large_device_img">

                            <div class="col-sm-12 col-md-12 col-lg-12 large_img_div" style="padding: 0px;">
                                <img class="img img-responsive"
                                src="@foreach($variation->media as $media){{ $media->display_url }}@endforeach" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="product_short_info">
                            <div class="heading">
                                <!-- Title Name -->
                                <h3>{{ $variation->product->name}}&nbsp;{{$variation->name != "DUMMY" ? $variation->name : '' }}</h3>
                            </div>
                            <div class="product_short_info-price">
                                <!-- Pricing -->
                                <span class="actual-price">
                                    Rs. {{ number_format($variation->sell_price_inc_tax,2) }}
                                </span>
                                <span class="discount-price text-muted">
                                    @if($variation->market_price>0)
                                        Rs. {{ number_format($variation->market_price,2) }}
                                    @endif
                                </span>
                                <!-- Pricing -->
                
                            </div>
                            <hr>
                            <!-- product description -->
                            <div class="product_short_info-desc">
                                {!! $variation->product->product_description !!}
                            </div>
                            <div class="product_short_info-quantity">
                                <label for="quantity">Quantity</label>
                                <div class="d-flex qty-number">
                                    <div class="btn-minus plus-minus px-2 pl-0"><i class="fas fa-minus"></i>
                                    </div>
                                    <input value="1" class="input_quantity"/>
                                    <div class="btn-plus plus-minus px-2"><i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <div class="product_short_info-buttons">
                                <div
                                    class="d-flex justify-content-between   flex-column flex-lg-row flex-md-row align-items-start align-items-lg-center align-items-md-center align-items-sm-start">
                                    <div class="btn_add-to-cart my-sm-2 my-2 my-md-0 my-lg-0">
                                        <!-- <a href="#!">
                                         <button class=" uk-button view-cart">Add to Cart&nbsp;<i
                                                    class="fas fa-cart-plus"></i></button>
                                        </a> -->
                                        <button class="uk-button view-cart" id="add_to_carts" product_id="{{$variation->id}}">Add to Cart&nbsp;<i
                                        class="fas fa-cart-plus"></i></button>
                                    </div>

                                    <div class="btn_add-to-cart my-sm-2 my-2 my-md-0 my-lg-0">
                                        <button class=" uk-button view-cart" id="product_buy_now" product_id="{{$variation->id}}"
                                            >Buy Now &nbsp;<i class="fas fa-shopping-cart"></i></button>
                                        
                                    </div>
                                    <div class=" btn_add-to-wishlist my-sm-2 my-2 my-md-0 my-lg-0">
                                        {{--<button class=" uk-button checkout">Add To Wishlist &nbsp;<i--}}
                                                {{--class="far fa-heart"></i></button>--}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="product_short_info-social_media">
                                <ul class="liststyle--none social-icons d-flex align-items-center flex-wrap">
                                    <li class="social-icon">
                                        Follow Us On:
                                    </li>
                                    <li class="social-icon ">
                                        <a class="facebook fab fa-facebook-square" href="" target="_blank">

                                        </a>
                                    </li>
                                    <li class="social-icon">
                                        <a class="twitter fab fa-twitter-square" href="" target="_blank">

                                        </a>
                                    </li>
                                    <li class="social-icon ">
                                        <a class="google-plus fab fa-google-plus-square" href="" target="_blank">

                                        </a>
                                    </li>
                                    <li class="social-icon ">
                                        <a class="linked-in fab fa-linkedin" href="" target="_blank">

                                        </a>
                                    </li>

                                </ul>


                            </div> -->
                        </div>
                    </div>
                </div>
                
                <!-- Description and information -->
                <!-- <div class="row">
                    <div class="single-tour-tabs ">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-description" role="tab" data-toggle="tab"
                                    aria-expanded="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#tab-information" role="tab" data-toggle="tab"
                                    aria-expanded="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#tab-reviews" role="tab" data-toggle="tab"
                                    aria-expanded="false">Reviews (1)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active description " id="tab-description">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, deleniti in
                                    reiciendis voluptatem cupiditate mollitia ipsa qui debitis quis possimus ad esse
                                    iusto! Quod itaque, voluptatibus cumque saepe laborum aliquid.</p>

                            </div>
                            <div role="tabpanel" class="tab-pane fade itinerary_tab " id="tab-information">
                                <ul>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, itaque?
                                    </li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                </ul>

                            </div>

                            <div role="tabpanel" class="tab-pane fade reviews " id="tab-reviews">
                                <div class="">

                                    <form action="">
                                        <div class="form-group">
                                            <label for="">
                                                Name
                                            </label>
                                            <input type="text" placeholder="Your Name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                Email
                                            </label>
                                            <input type="email" placeholder="Your Name" class="form-control">
                                        </div>

                                    </form>
                                    <div class="form-group">
                                        <span class="review--heading">Add review</span>
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5"><label class="full"
                                                for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4"><label class="full"
                                                for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3"><label class="full"
                                                for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2"><label class="full"
                                                for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1"><label class="full"
                                                for="star1" title="Sucks big time - 1 star"></label>

                                        </fieldset>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <form action="" method="post" class="review-form">

                                    <label for="comment">write something</label>
                                    <textarea type="text" class="form-control" id="comment"
                                        placeholder="write something" rows="3" cols="100">
                                </textarea>
                                    <button class="btn-view_more float-right mt-1 " href=""> comment</button>
                                    <div class="clearfix"></div>
                                </form>
                                <div class="clearfix"></div>
                                <p class="review-user">4.1 average based on 254 reviews.</p>
                                <hr style="border:3px solid #f1f1f1; width:70%">
                                <div class="row review-rating">
                                    <div class="side">
                                        <div>5 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-5"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>150</div>
                                    </div>
                                    <div class="side">
                                        <div>4 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-4"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>63</div>
                                    </div>
                                    <div class="side">
                                        <div>3 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-3"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>15</div>
                                    </div>
                                    <div class="side">
                                        <div>2 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-2"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>6</div>
                                    </div>
                                    <div class="side">
                                        <div>1 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-1"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>20</div>
                                    </div>
                                </div>
                                <div class="review-container">
                                    <h3 class="review-title">Reviews</h3>
                                    <article class="reviews" style="display: block;">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> Jhon Deo</span>&nbsp;<span
                                                class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>
                                            <p>lorem ipsum sumet is the inlu one that is very popular in webs designing
                                                to place a dumy text</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                    <article class="reviews" style="display: block;">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> Jhon Deo</span>&nbsp;<span
                                                class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>
                                            <p>lorem ipsum sumet is the inlu one that is very popular in webs designing
                                                to place a dumy text</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                    <article class="reviews" style="display: block;">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> Jhon Deo</span>&nbsp;<span
                                                class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>
                                            <p>lorem ipsum sumet is the inlu one that is very popular in webs designing
                                                to place a dumy text</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                    <article class="reviews">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> Jhon Deo</span>&nbsp;<span
                                                class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>
                                            <p>lorem ipsum sumet is the inlu one that is very popular in webs designing
                                                to place a dumy text</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                    <article class="reviews">
                                        <figure class="user-image">
                                            <img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"
                                                alt="">
                                        </figure>
                                        <div class="review-right">
                                            <span class="username"> Jhon Deo</span>&nbsp;<span
                                                class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>
                                            <p>lorem ipsum sumet is the inlu one that is very popular in webs designing
                                                to place a dumy text</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>


                                    <button class="btn show-more center"> show more</button>
                                    <div class="clearfix"></div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->

            </div>

        </section>

        <!-- START OF FOOTER -->
       
        <!-- END OF FOOTER -->


</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(this).on('click', '#product_buy_now', function (event) {
                event.preventDefault();
                let quantity = $('.input_quantity').val();
                let product_variation_id = $(this).attr('product_id');
                $.ajax({
                    method: 'POST',
                    url: '{{ route('product_buy_now') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        quantity: quantity,
                        variation_id: product_variation_id
                    },
                    success: function (response) {
                        if (response.status == 'error') {
                            showFrontendAlert('warning', response.msg);
                        } else {
                            location.href = "{{ route('product.checkout') }}";
                        }
                    },
                    error: function (response) {
                        if (response.error) {
                            window.location.href = document.location.origin + '/shop/login';
                        }
                    }
                });
            });
        });
    </script>
@endsection

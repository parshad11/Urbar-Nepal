@extends('ecommerce.layouts.master')
@section('content')

<section id="Allcategory-page">
            <div class="container ">
                <h2 class="text-center my-3">Categories</h2>
                <div class="row all-category-row ">      
                    @if(isset($categories))
                    @foreach($categories as $category)
                    <div class="col-lg-3 col-sm-6">
                        <div class="card all-category ">
                            <a href="{{route('categories_product_list',['idd' => $category->id, 'slugg' => $category->slug])}}"><h6 class="card-header text-center all-category-header" > {{$category->name}}</h6></a>
                            
                            <ul class="all-category-list">
                            
                            @foreach ($sub_categoreis as $subcategory)
                            @if ( $subcategory->parent_id == $category->id )
                            <a href="{{route('product_sub_category', ['id' => $subcategory->id ,'slug' => $subcategory->slug])}}" class="nav_a"><li> {{ $subcategory->name }} </li></a>
                                @endif
                               @endforeach
                               
                            </ul>
                           
                            
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>

        </section>
          <!-- POPULAR PRODUCTS -->
          <section id="popular-category">
            <div class="container-fluid">
                <h3> Popular Categories</h3>
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


                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-100 text-right align-items-center justify-content-between">

                    <div><a href="category.html" class="m-2 uk-button view-cart">view more</a></div>
                </div>
            </div>


        </section>
@endsection
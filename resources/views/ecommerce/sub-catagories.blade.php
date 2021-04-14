@extends('ecommerce.layouts.master')
@section('content')
<!--  category -->
<?php
    // dd($category_of_product);
?>

<section id="category-filter">
    <div class="w-100 mx-auto">
        <div class="row my-4">
            <div class=" col-lg-2 col-md-3 col-sm-12 px-4 ">
                <aside class="left__side mb mt-3">

                    <ul uk-accordion="multiple: true">
                    
                    @if(isset($category_of_product))
                    @foreach($category_of_product as $category_of_product)
                        <li class="">
                            <a class="uk-accordion-title" href="{{route('categories_product_list',['idd' => $category_of_product->id, 'slugg' => $category_of_product->slug])}}">
                                <h5> {{$category_of_product->name}}</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="scrollbar   mCustomScrollbar">
                                    <ul>
                                    @foreach($sub_caategory_of_product as $sub_caategory_of_product)
                                    @if($sub_caategory_of_product->parent_id==$category_of_product->id)
                                        <li class="category-list"><a class="link-category" href="{{route('product_sub_category', ['id' => $sub_caategory_of_product->id ,'slug' => $sub_caategory_of_product->slug])}}">{{$sub_caategory_of_product->name}}
                                            </a></li>
                                            @endif
                                            @endforeach

                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach 
                        @endif
                        </li>
                        
                        <li class=" ">
                            <a class="uk-accordion-title" href="#">
                                <h5> Price</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="price-list ">



                                    <h6>Range :</h6>
                                    <form action="{{route('product_sub_category',['id' => $range_id, 'slug' => $range_slug])}}" method="Get" class="price-range mt-2 mx-auto d-flex flex-column">
                                    <div class="form-row mx-auto">
                                    <input type="number" name="min_price" placeholder="Min." min="1">
                                        &nbsp; - &nbsp;
                                        <input type="number" name="max_price" placeholder="Max." min="1">
                                        </div>
                                        
                                        
                                        <div class="form-row mx-auto mt-2">
                                            <button type="submit" class="center uk-button view-cart">Go</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </li>

                    </ul>

                </aside>

            </div>
            <div class=" col-lg-10 col-md-9 box-shadow-xy">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="Name__of__category mt-2">
                        <div class="heading d-flex">
                            <h3>Category Products </h3>
                        </div>

                    </div>
                </div>
                <div class="product-category white-product">
                
                @forelse($sub_category_products as $product)
                @foreach ($product->product_variations as $product_variation)
                @foreach ($product_variation->variations as $variation)
                    <article class="product mt-2 instock sale purchasable">
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
                                            <a href="singlepage.html">{{$variation->product->name}}
                                                            &nbsp;{{$variation->name != "DUMMY" ? $variation->name : ''}} </a>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                
                                    <div class="product_price">
                                    @if($variation->market_price>0)
                                        <div class="product_price-actual">
                                         Price
                                                                :Rs. {{ number_format($variation->market_price,2) }}
                                        </div>
                                        @endif
                                        <!-- <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.70
                                            </span>
                                            <span>-20%</span>
                                        </div> -->
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
        </div>
    </div>
</section>
@endsection
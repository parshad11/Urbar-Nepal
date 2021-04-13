@extends('ecommerce.layouts.master')
@section('content')
<!--  category -->
<?php
// dd($sub_caategory_of_product);
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
                        <li class=" ">
                            <a class="uk-accordion-title" href="#">
                                <h5> Price</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="price-list ">



                                    <h6>Range :</h6>
                                    <form action="" class="price-range mt-2 mx-auto d-flex">
                                        <input type="number" placeholder="Min." min="1">
                                        &nbsp; - &nbsp;
                                        <input type="number" placeholder="Max." min="1">
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

                    <div class="product_sort_by ">
                        <div class="d-flex align-items-center">
                            <div class="heading">
                                <h5>Sort by: &nbsp;</h5>

                            </div>
                            <select name="" class="uk-select" style="width: 100px">
                                <option value="">New</option>
                                <option value="">Price</option>
                                <option value="">Popular</option>
                            </select>
                        </div>

                    </div>
                </div>
                
                <div class="product-category white-product">
                
                @forelse($category_products as $product)
                @foreach ($product->product_variations as $product_variation)
                @foreach ($product_variation->variations as $variation)
                    <article class="product mt-2 instock sale purchasable">
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
                                            <a href="{{route('product_single',$variation->sub_sku)}}">
                                                {{$variation->product->name}}&nbsp;{{$variation->name != "DUMMY" ? $variation->name : ''}} </a>
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
                                        @if($variation->market_price>0)
                                        <div class="product_price-discount">
                                            <span class="line-through">
                                                Rs.{{ number_format($variation->market_price,2) }}
                                            </span>
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
        </div>
    </div>
</section>
@endsection
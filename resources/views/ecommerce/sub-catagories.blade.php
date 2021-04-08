@extends('ecommerce.layouts.master')
@section('content')
<!--  category -->
<?php
    // dd($sub_category);
?>
<section id="category-filter">
    <div class="w-100 mx-auto">
        <div class="row my-4">
            <div class=" col-lg-2 col-md-3 col-sm-12 px-4 ">
                <aside class="left__side mb mt-3">

                    <ul uk-accordion="multiple: true">
                        <li class="">
                            <a class="uk-accordion-title" href="#">
                                <h5> Category</h5>
                            </a>
                            <div class="uk-accordion-content">
                                <div class="scrollbar   mCustomScrollbar">
                                    <ul>
                                        <li class="category-list"><a class="link-category" href="#">category 1
                                            </a></li>
                                        <li class="category-list"><a class="link-category" href="#">category 2
                                            </a></li>

                                    </ul>
                                </div>
                            </div>
                        </li>
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
                @if(isset($sub_category))
                @foreach($sub_category as $sub_category)
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
                                            <a href="singlepage.html">{{$sub_category->name}} </a>
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
                    @endforeach
                    @endif
                    
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
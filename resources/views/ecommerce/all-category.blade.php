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
                            <li class="py-1 px-1"><a  href="{{route('product_sub_category', ['id' => $subcategory->id ,'slug' => $subcategory->slug])}}" class="nav_a">{{ $subcategory->name }}</a></li>
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
                        <li><a class="nav-item nav-link active" data-toggle="tab"
                               href="#all" aria-controls="all">All</a>
                        </li>
                        @foreach($popular_category as $category)
                            <li><a class="nav-item nav-link " data-toggle="tab"
                                   href="#{{$category->slug}}" aria-controls="{{$category->slug}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <?php
                    $category = App\Category::orderBy('view', 'asc')->orderBY('created_at', 'asc')->get();
                    foreach ($category as $category) {
                        $active_category = $category->find($category->id);
                    }
                    ?>
                </nav>
                <div class="tab-content popular-category" id="nav-tabContent">
                    <div class="tab-pane active show  fade "
                         id="all" role="tabpanel"
                         aria-labelledby="nav-all-tab">
                        <div class="product-category white-product">
                            <div class="category--slider owl-carousel">
                                @foreach($products as $product)
                                    @foreach($category_product->where('category_id',App\Category::find($product->category_id)->id) as $product)
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
                                                                        <a href="{{route('product_single',$variation->sub_sku)}}">{{$product->name}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="product_price">
                                                                    <div class="product_price-actual">
                                                                        Rs. {{ number_format($variation->sell_price_inc_tax,2) }}
                                                                        /{{$variation->product->unit->short_name}}
                                                                    </div>
                                                                    <div class="product_price-discount">
                                                <span class="line-through">
                                                   <span class="line-through">
                                                        Rs. {{ number_format($variation->market_price,2) }}
                                                    </span>
                                                </span>
                                                                        {{--<span>-20%</span>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="product_cart">
                                                                    <a href="javascript:void(0)">
                                                                        <ion-icon name="cart"
                                                                                  uk-tooltip=" Add to Cart"></ion-icon>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @foreach($category_product as $product)
                        <div class="tab-pane fade "
                             id="{{App\Category::find($product->category_id)->slug}}" role="tabpanel"
                             aria-labelledby="nav-{{App\Category::find($product->category_id)->slug}}-tab">
                            <div class="product-category white-product">
                                <div class="category--slider owl-carousel">
                                    @foreach($category_product->where('category_id',App\Category::find($product->category_id)->id) as $product)
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
                                                                        <a href="{{route('product_single',$variation->sub_sku)}}">{{$product->name}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="product_price">
                                                                    <div class="product_price-actual">
                                                                        Rs. {{ number_format($variation->sell_price_inc_tax,2) }}
                                                                        /{{$variation->product->unit->short_name}}
                                                                    </div>
                                                                    <div class="product_price-discount">
                                                <span class="line-through">
                                                   <span class="line-through">
                                                        Rs. {{ number_format($variation->market_price,2) }}
                                                    </span>
                                                </span>
                                                                        {{--<span>-20%</span>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="product_cart">
                                                                    <a href="javascript:void(0)">
                                                                        <ion-icon name="cart"
                                                                                  uk-tooltip=" Add to Cart"></ion-icon>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="w-100 text-right align-items-center justify-content-between">

                    <div><a href="category.html" class="m-2 uk-button view-cart">view more</a></div>
                </div>
            </div>


        </section>
@endsection
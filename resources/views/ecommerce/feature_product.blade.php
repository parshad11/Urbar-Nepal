@extends('ecommerce.layouts.master')
@section('content')
    <!-- Featured category -->
    <section id="category-filter">
            <div class="w-100 mx-auto">
                <div class="row my-4">
                 
                    <div class=" col-lg-10 col-md-9 box-shadow-xy">

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="Name__of__category mt-2">
                                <div class="heading d-flex">
                                    <h3>Feature Products </h3>
                                </div>

                            </div>
                            
                        </div>
                        <div class="product-category white-product">
                        @forelse($featured_products as $product)
                            @foreach ($product->product_variations as $product_variation)
                                @foreach ($product_variation->variations as $featured)
                                        <article class="product mt-2 instock sale purchasable">
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
                                                                <a href="{{route('product_single',$featured->sub_sku)}}">
                                                                    {{$featured->product->name}}&nbsp;{{$featured->name != "DUMMY" ? $featured->name : ''}}
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="product_price">
                                                            <div class="product_price-actual">
                                                                Rs.{{ number_format($featured->sell_price_inc_tax,2) }}/{{$featured->product->unit->short_name}}
                                                            </div>
                                                            @if($featured->market_price>0)
                                                            <div class="product_price-discount">
                                                                <span class="line-through">
                                                                    Rs.{{ number_format($featured->market_price,2) }}
                                                                </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="product_cart">
                                                            <a href="javascript:void(0)" id="add_to_carts" product_id="{{$featured->id}}">
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
                        {{ $featured_products->links() }}
                    </div>
                </div>
            </div>
        </section>
@endsection

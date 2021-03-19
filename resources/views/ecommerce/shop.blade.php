@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
@endsection
@section('content')
    <!-- SHOP SECTION -->
    <div class="shop">

        <!-- OVERLAY -->
        <div class="banner">
            <img class="img img-responsive" src="https://merogroceries.com/images/media/2020/10/YXFgk16107.png" alt="">
        </div>
    {{--<div class="shop-banner">
        <div class="image"><img src="https://merogroceries.com/images/media/2020/10/YXFgk16107.png" alt=""></div>
        <!-- <div class="overlay"></div> -->
        <!-- <a href="#content" class="btn btn-success">Shop Now</a> -->
    </div>--}}

    <!-- CONTENT -->
        <div class="content container" id="content">
            <div class="row">
                <div class=" col-md-3 left">
                    <div class="download">
                        <div class="title"> Catalogue</div>

                        <div class="download-options">
                            <button>Catalogue 1&nbsp;<i class="fas fa-download"></i></button>

                            <button>Catalogue 2&nbsp;<i class="fas fa-download"></i></button>
                        </div>
                    </div>
                    @if (isset($special_category))
                    <div class="category">
                        <div class="title"> SPECIAL SALE</div>

                        <ul class="category-list">

                        @foreach ($special_category->sub_categories as $sub_cat)
                            <li><a href="{{route('product_subcategory',[$special_category->slug,$sub_cat->slug])}}">{{$sub_cat->name}}</a></li>                            
                        @endforeach   

                        </ul>
                    </div>                     
                    @endif

                    @if (isset($categories))
                    <div class="category">
                        <div class="title"> Categories</div>

                        <ul class="category-list">

                            @foreach ($categories as $category)
                            <li class="main"><a href="{{route('product_category',$category->slug)}}">{{$category->name}} </a>
                                @if($category->sub_categories!= null)
                                &nbsp;<i style="float: right; margin:auto" class="fas fa-chevron-right"></i>
                                <ul class="sub">
                                    @foreach ($category->sub_categories as $sub_category)
                                        
                                    <li><a href="{{route('product_subcategory',[$category->slug,$sub_category->slug])}}">{{$sub_category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                                @endif
                        @endforeach   

                        </ul>
                    </div>                     
                    @endif
                </div>
                <div class="col-md-9 right">

                    <!-- SEARCH BOX -->
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ...."
                                   aria-describedby="basic-addon2">

                            <span class="input-group-addon btn btn-success" id="basic-addon2">Search &nbsp;<i
                                        class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                    </div>

                    <!-- PRODUCTS -->
                    <div class="row">

                        @forelse($products as $product)
                            @foreach ($product->product_variations as $product_variation)
                                @foreach ($product_variation->variations as $variation)
                                    <div class="card col-md-4 col-sm-4 col-xs-6">
                                        <div class="product">
                                            <div class="img">
                                                <a href="single.htm">
                                                    <img class="img img-responsive"
                                                         src="@if($variation->name != "DUMMY")
                                                         @foreach($variation->media as $media)
                                                         {{-- {!! $media->thumbnail([300, 300]) !!} --}}
                                                         {{$media->display_url}}
                                                         @endforeach
                                                         @else
                                                         {{$variation->product->image_url}}
                                                         @endif" alt=""></a>
                                            </div>
                                            <div class="description">
                                                <div class="title"><b><a href="{{route('product_single',$variation->sub_sku)}}">{{$variation->product->name}}
                                                            &nbsp;{{$variation->name != "DUMMY" ? $variation->name : ''}}</a></b>
                                                </div>
                                                <div class="price">

                                                    {{-- <p>{{$variation->media[0]->path}}</p> --}}
                                                    <div class="kalimati"><small>Kalimati Price :Rs. {{$variation->market_price}}</small></div>

                                                    <div class="offer">Price : Rs.{{$variation->sell_price_inc_tax}}</div>
                                                </div>
                                                <button class="btn btn-success" id="add_to_carts" product_id="{{$variation->id}}">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endforeach
                        @empty
                        <div class="card col-lg-12">
                            <div class="row">
                                <div class="text-center" style="padding: 50px ">
                                    <h1>No Product Found</h1>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    {{-- {{$product->links()}} --}}
                </div>
            </div>

        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
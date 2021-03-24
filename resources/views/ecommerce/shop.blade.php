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
            <img class="img img-responsive" src="" alt="">
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
                            <button>Catalogue 1&nbsp;<i class="fa fa-download" aria-hidden="true"></i></button>

                            <button>Catalogue 2&nbsp;<i class="fa fa-download" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    @if (isset($special_category))
                        <div class="category">
                            <div class="title"> SPECIAL SALE</div>

                            <ul class="category-list">

                                @foreach ($special_category->sub_categories as $sub_cat)
                                    <li>
                                        <a href="{{route('product_subcategory',[$special_category->slug,$sub_cat->slug])}}">{{$sub_cat->name}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    @endif

                    @if (isset($categories))
                        <div class="category">
                            <div class="title"> Categories</div>

                            <ul class="category-list">

                                @foreach ($categories as $category)
                                    <li class="main"><a
                                                href="{{route('product_category',$category->slug)}}">{{$category->name}} </a>
                                        @if($category->sub_categories!= null)
                                            &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"style="float: right; margin:auto"></i>
                                            <ul class="sub">
                                                @foreach ($category->sub_categories as $sub_category)

                                                    <li>
                                                        <a href="{{route('product_subcategory',[$category->slug,$sub_category->slug])}}">{{$sub_category->name}}</a>
                                                    </li>
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
                            <input type="text" class="form-control" name="query" placeholder="Search ...."
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
                                                <a href="{{route('product_single',$variation->sub_sku)}}">
                                                    <img class="img img-responsive"
                                                         src="@foreach($variation->media as $media){{ $media->display_url }}@endforeach"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="description">
                                                <div class="title"><b><a
                                                                href="{{route('product_single',$variation->sub_sku)}}">{{$variation->product->name}}
                                                            &nbsp;{{$variation->name != "DUMMY" ? $variation->name : ''}}</a></b>
                                                </div>
                                                <div class="price">

                                                    {{-- <p>{{$variation->media[0]->path}}</p> --}}
                                                    <div class="kalimati"><small>Kalimati Price
                                                            :Rs. {{ number_format($variation->market_price,2) }}</small>
                                                    </div>

                                                    <div class="offer">Price :
                                                        Rs.{{ number_format($variation->sell_price_inc_tax,2) }}
                                                        /{{$variation->product->unit->short_name}}</div>
                                                </div>
                                                <button class="btn btn-success" id="add_to_carts"
                                                        product_id="{{$variation->id}}">Add to Cart
                                                </button>
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
    @if (session()->has('success'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Order Added Successfully',
                    showConfirmButton: false,
                    timer: 5000
                })
            })
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "{{Session::get('error')}}",
                    showConfirmButton: false,
                    timer: 3000
                })
            })
        </script>
    @endif
    <script>
        $(function () {
            autocomplete('#searchTextLg', {}, [{
                source: function (request, response) {
                    $.ajax({
                        url: '{{route('autocomplete.search')}}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            query: $('#searchTextLg').val(),
                        },
                        success: function (data) {
                            response($.map(data, function (obj) {

                                if(obj.variation_name !== "DUMMY"){
                                    return {
                                        name: obj.name +' '+obj.variation_name,
                                        slug: obj.sub_sku,
                                    };
                                }
                                return {
                                    name: obj.name,
                                    slug: obj.sub_sku,
                                };
                            }));
                        }
                    });
                },
                displayKey: 'name',
                template: {
                    header: '<div class="aa-suggestions-category">Products</div>',
                    suggestions: function (suggestion) {
                        return  '<span></span>';
                    }
                },
                empty: '<div class="aa-empty">No matching players</div>',

            }]);
        });
    </script>
@endsection
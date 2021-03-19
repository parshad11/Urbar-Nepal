@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="single-item-link">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
          </ol>
    </div>
    {{-- {{$product}} --}}
    <div class="row">
      <div class="col-sm-5 item-photo">
        @if($variation->name != "DUMMY")
        @foreach($variation->media as $media)
        {!! $media->thumbnail([300, 300]) !!}
        {{-- {{$media->display_url}} --}}
        @endforeach
        @else
        <img class="img img-responsive"
        src="{{$variation->product->image_url}}" alt="">
        @endif
      </div>
      <div class="col-sm-7" style="border:0px solid gray">
        <!-- Title & Description -->
        <h3>{{$variation->product->name}}</h3>

        <!-- Pricing -->
        <h5>Kalimati Price : Rs {{$variation->market_price}}</h5>
        <h4>Price : Rs {{$variation->sell_price_inc_tax}}</h4>

        <!-- Quantity-->


        <div class="section" style="padding-bottom:20px;">
          <h5 class="title-attr">Order Quantity</h5>
          <div style="display:flex;">
            <div class="btn-minus plus-minus"><span class="glyphicon glyphicon-minus"></span></div>
            <input value="1" class="input_quantity"/>
            <div class="btn-plus plus-minus"><span class="glyphicon glyphicon-plus"></span></div>
          </div>
        </div>

        <!-- buttons -->
        <div class="section carts" style="padding-bottom:20px;">
          <button class="btn btn-success" id="add_to_carts" product_id="{{$variation->id}}">Add to Cart</button>

          <button class="btn btn-success">Buy Now</button>

        </div>
        <h4>Product Description</h3>
        <div class="description">

        <p>{!!$variation->product->product_description!!}</p>
        </div>
      </div>


    </div>
  </div>
</div>


<div class="container single-2">

  <h2>You May Like</h2>
  <div class="row ">
    @forelse($products as $product)
        @foreach ($product->product_variations as $product_variation)
            @foreach ($product_variation->variations as $variation)
                <div class="card col-md-3 col-sm-4 col-xs-12">
                    <div class="product">
                        <div class="img">
                            <a href="{{route('product_single',$variation->sub_sku)}}">
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
    @endforelse
  </div>
</div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
    
@endsection
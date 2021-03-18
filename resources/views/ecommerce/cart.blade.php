@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
@endsection
@section('content')
<div class="container cart">
    <div class="row">
      <div class="col-xs-12" style="margin-top: 2%;">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">
              <div class="row">
                <div class="col-xs-6">
                  <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                </div>

              </div>
            </div>
          </div>
          <div class="panel-body">
              @foreach ($cart_items as $item)                  
            <div class="row productInCart">
                <div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
                </div>
                <div class="col-xs-4">
                  <h4 class="product-name"><strong>{{$item->variation->product->name}}&nbsp;{{$item->variation->name}}</strong></h4>
                </div>
                <div class="col-xs-6">
                  <div class="col-xs-3 text-right">
                    <h6><strong>{{$item->variation->sell_price_inc_tax}} <span class="text-muted">x</span></strong></h6>
                  </div>
                  <div class="col-xs-2">
                    <input type="text" class="form-control input-sm" value="{{$item->quantity}}">
                  </div>
                  <div class="col-xs-3">
                    <button type="button" class="btn btn-link btn-xs deleteFromCart">
                      <span class="glyphicon glyphicon-trash"> </span>
                    </button>
                  </div>
  
                  <div class="col-xs-4">
                    <strong>{{$item->total_price}} Rs</strong>
                  </div>
                </div>
              </div>
              @endforeach

          </div>
          <div class="panel-footer">
            <div class="row text-center">

              <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block">
                  <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                </button>

              </div>
              <div class="col-xs-4">
                <h4 class="text-right">Total <strong>Rs : {{$total_sum}}</strong></h4>
              </div>
              <div class="col-xs-3">
                <a type="button" class="btn btn-success btn-block" href="{{route('product.checkout')}}">
                  Checkout
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
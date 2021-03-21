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
          @include('ecommerce.cart_detail')

          <div class="panel-footer">
            <div class="row text-center">

              <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block">
                  <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                </button>

              </div>
              {{-- <div class="col-xs-4">
                <h4 class="text-right" id="cart_total_price">Total <strong>Rs : {{$total_sum}}</strong></h4>
              </div> --}}
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
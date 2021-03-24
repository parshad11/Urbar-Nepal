@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
@endsection
@section('content')
    <!-- Account Start -->
    <section class="account-area jarallax overlay-white">
        <img class="jarallax-img" src="images/bg/6.jpg" alt="">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="tab text-center">
                        <h3 style="color: #ffffff;">Account Information</h3>
                        <br>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Section1" role="tab" data-toggle="tab">Details</a>
                            </li>
                            <li role="presentation"><a href="#Section2" role="tab" data-toggle="tab">Orders</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs" style="color: #ffffff;">
                            <div class="tab-pane fade in active" id="Section1">
                                <div class="border p-4">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4 style="color: #ffffff;">Full Name</h4>
                                        </div>
                                        <div class="col-sm-9 ">
                                            {{$customer->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4 style="color: #ffffff;">Email</h4>
                                        </div>
                                        <div class="col-sm-9 ">
                                            {{$customer->email}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4 style="color: #ffffff;">Phone</h4>
                                        </div>
                                        <div class="col-sm-9 ">
                                            {{$customer->mobile}}
                                        </div>
                                    </div>
                                    <hr>
                                    <!--<div class="row">
                                        <div class="col-sm-3">
                                            <h4 style="color: #ffffff;">Mobile</h4>
                                        </div>
                                        <div class="col-sm-9 ">
                                            (320) 380-4539
                                        </div>
                                    </div>
                                    <hr>-->
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4 style="color: #ffffff;">Address</h4>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{$customer->contact_address}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="Section2">
                                @if(isset($orders))
                                    @forelse($orders as $order)
                            
                                        @if(isset($order->sell_lines) && $order->sell_lines!=null)
                                            @foreach($order->sell_lines as $order_item)
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2">
                                                        <img class="img img-responsive" src="@foreach($order_item->variations->media as $media){{ $media->display_url }}@endforeach" alt="">
                                                        {{--<img src="@if($order_item->variations->name != "DUMMY")
                                                        @foreach($order_item->variations->media as $media)
                                                         {!! $media->thumbnail([300, 300]) !!}
                                                        {{$media->display_url}}
                                                        @endforeach
                                                        @else
                                                        {{$order_item->variations->product->image_url}}
                                                        @endif"
                                                             alt="">--}}
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 ">
                                                        <a href="" style="color: #ffffff;">

                                                            <h5 class="mt-xs-5"
                                                                style="color: #ffffff;">{{$order_item->variations->product->name}}
                                                                &nbsp;{{$order_item->variations->name != "DUMMY" ? $order_item->variations->name : ''}}</h5>
                                                            <span>Quantity : {{ $order_item->quantity }}&nbsp;{{$order_item->variations->product->unit->short_name}}</span><br>
                                                            <span>Order date : {{\Carbon\Carbon::parse($order->transaction_date)->format('M d, Y')}}</span>
                                                        </a>
                                                    </div>

                                                    <div class="col-md-3 col-sm-3">

                                                        <h4 style="color: #ffffff;">Rs. {{ number_format($order->final_total,2) }}</h4>
                                                        <div>
                                                            <span><strong>Status :</strong></span>
                                                            <span>{{ ($order->status =='draft') ? 'Pending' : 'Accepted'}}</span>
                                                        </div>
                                                        <div>
                                                            <span><strong>Delivery Status:</strong></span>
                                                            <span>{{($order->delivery)?@ucwords($order->delivery->delivery_status):'Not Assigned'}}</span>
                                                        </div>

                                                    </div>

                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif
                                    @empty
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
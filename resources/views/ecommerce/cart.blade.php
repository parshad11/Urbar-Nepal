@extends('ecommerce.layouts.master')
@section('content')
        <!-- MOBILE NAV START -->
        <!-- <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
            <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close style="color: #ef3e42;"></button>
    
            <section class="mobile-nav">
                <form class="uk-search uk-search-default">
                <button type="button" class="uk-search-icon-flip" uk-search-icon style="top:0;"></button>
                <input class="uk-search-input" type="search" placeholder="Search...">
                </form>
                <ul class="metismenu" id="menu">
                <div class="panel-group">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse1">Home</a>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <ul class="list-group">
    
                        </ul>
                    </div>
    
    
                    </div>
    
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse2">Categories</a>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <ul class="list-group ">
                        <li class="list-group-item bg-transparent border-0">One</li>
                        <li class="list-group-item bg-transparent border-0">Two</li>
                        <li class="list-group-item bg-transparent border-0">Three</li>
                        </ul>
                    </div>
                    </div>
                </ul>
            </section>
            </div>
        </div> -->
        <!-- all category -->
        <section id="shopping-cart">
            <div class="container box-shadow mt-2 mb">
                <h1>Shopping Cart</h1>

                <div class="shopping-cart">

                    <div class="column-labels">
                        <label class="product-image text-center">Image</label>
                        <label class="product-details">Product</label>
                        <label class="product-price">Price</label>
                        <label class="product-quantity">Quantity</label>
                        <label class="product-removal">Remove</label>
                        <label class="product-line-price">Total</label>
                    </div>


                    @if(isset($cart_items) && count($cart_items)>0)
                        @php
                            $total_sum = 0;
                        @endphp
                        @foreach ($cart_items as $key=>$item)
                        @php
                            $total_sum = $total_sum + $item['total_price'];
                        @endphp
                    <div class="product" id="cart_item_detail">
                    
                        <div class="product-image">
                            <img src="@foreach($item->variation->media as $media){{ $media->display_url }}@endforeach">
                        </div>
                        <div class="product-details">
                            <div class="product-title">
                                {{$item->variation->product->name}}&nbsp;{{$item->variation->name != "DUMMY" ? $item->variation->name : ''}}
                            </div>
                            <!-- <p class="product-description">
                            {{$item->variation->product->product_description}}&nbsp;{{$item->variation->product_description != "DUMMY" ? $item->variation->product_description : ''}}
                            </p> -->
                        </div>
                        <div class="product-price">
                            {{ number_format($item->variation->sell_price_inc_tax,2) }}
                        </div>
                        <div class="product-quantity">
                            <div class="d-flex flex-column qty-number">
                                <div class="btn-minus plus-minus px-2 pl-0"><i class="fas fa-minus"></i>
                                </div>
                                <input value="{{$item->quantity}}" class="input_quantity">
                                <div class="btn-plus plus-minus px-2"><i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="product-removal">
                            <button class=" btn btn-danger remove-product" data-id="{{$item->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div class="product-line-price">{{ number_format($item->total_price,2) }}</div>

                    </div>
                    @endforeach



                    <div class="totals">
                        <!-- <div class="totals-item">
                            <label>Subtotal</label>
                            <div class="totals-value" id="cart-subtotal">71.97</div>
                        </div>
                        <div class="totals-item">
                            <label>Tax (13%)</label>
                            <div class="totals-value" id="cart-tax">3.60</div>
                        </div>
                        <div class="totals-item">
                            <label>Shipping</label>
                            <div class="totals-value" id="cart-shipping">15.00</div>
                        </div> -->
                        <div class="totals-item totals-item-total">
                            <label>Grand Total</label>
                            <div class="totals-value" id="cart-total">{{ number_format($total_sum,2) }}</div>
                        </div>
                    </div>
                    @else
                        <h4>No items left in cart</h4>
                    @endif
                    <a class="uk-button view-cart" href="{{route('front_dashboard')}}"> <span uk-icon="icon:chevron-left"></span>Continue
                        Shopping</a>
                    <a class="uk-button checkout" href="{{route('product.checkout')}}">Checkout</a>
                    <div class="clearfix"></div>

                </div>
            </div>
        </section>
        <!-- all category End -->


@endsection
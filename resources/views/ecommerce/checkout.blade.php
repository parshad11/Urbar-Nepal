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
        <!--  category -->
        <section id="check-out">
          
        <form action="{{action('Front\ShopController@store')}}" class="add-address" method="post" id="payment-form">
          @csrf
            <div class="container check-out">
                <div class="row">
                        <div class="col-md-7 col-sm-12 deliver__address" style="margin-bottom:10px; background: white">
                            <h2><span class="glyphicon glyphicon-home"></span> Delivery Address</h2>
                          
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <label for="fname">Frist Name</label>
                                        <input type="text" id="fname" class="form-control" name="first_name" readonly value="{{$customer->first_name}}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <label for="lname">Last Name</label>
                                        <input type="text" id="lname" class="form-control" name="last_name" readonly value="{{$customer->last_name}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="inputPhone">Phone</label>
                                        <input type="number" class="form-control" name="mobile" id="inputPhone" readonly value="{{$customer->mobile}}">
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-6 col-12">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" name="city"i d="inputCity" value="{{$customer->city}}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <label for="inputCity">Province</label>
                                        <input type="text" class="form-control" name="state" id="inputZone" value="{{$customer->state}}">
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-6 col-12">
                                        <label for="Address">ZIP Code</label>
                                        <input type="text" class="form-control" name="zip_code" id="inputCity" value="{{$customer->zip_code}}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <label for="inputAddress">Landmark</label>
                                        <input type="text" class="form-control" name="address_line_1" id="inputAddress" value="{{$customer->address_line_1}}">
                                    </div>
                                </div>
                                <input type="hidden" name="cart_items" id="cart_items" value="{{$cart_items}}">
                                <input type="hidden" name="total_price" id="total_price" value="{{$total_price}}">
                                <div class="row">
                                    
                                </div>
                        </div>

                        <div class="col-md-5 col-sm-12 ">
                            <div class="card ">
                                <div class="card-header" style="margin-bottom: 10px;">
                                    Review Order
                                    <div class="float-right">
                                        <small><a class="afix-1" href="{{ route('product.cart') }}">Edit Cart</a></small>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="card-block">
                                      <div class=" group">
                                        @forelse ($cart_items as $item)
                                          <div class="row">
                                                <div class="col-sm-3 col-3">
                                                    <img class="img-fluid"
                                                        src="@foreach($item->variation->media as $media){{ $media->display_url }}@endforeach" />
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <div class="col-12">
                                                      {{$item->variation->product->name}}&nbsp;{{$item->variation->name != 'DUMMY' ? $item->variation->name : '' }}
                                                    </div>
                                                    <div class="col-12">
                                                        <small>Quantity:<span>
                                                          {{$item->quantity}}{{$item->variation->product->unit->short_name}}
                                                        </span></small>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-3 text-right">
                                                    <h6><span>Rs</span>{{ number_format($item->variation->sell_price_inc_tax,2) }}</h6>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          <hr>
                                          @empty
                                        @endforelse
                                    </div>
                                        <!-- <div class="row">
                                            <div class="col-sm-3 col-3">
                                                <img class="img-fluid"
                                                    src="//c1.staticflickr.com/1/466/19681864394_c332ae87df_t.jpg" />
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <div class="col-12">Product name</div>
                                                <div class="col-12">
                                                    <small>Quantity:<span>1</span></small>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-3 text-right">
                                                <h6><span>$</span>25.00</h6>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <hr> -->
                                    <!-- <div class="row">
                                        <div class="col-12">
                                            <strong>Subtotal</strong>
                                            <div class="float-right"><span>$</span><span>200.00</span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-12">
                                            <small>Shipping</small>
                                            <div class="float-right"><span>-</span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <hr> -->

                                    <div class="row" style="padding: 0 0 10px">
                                        <div class="col-12">
                                            <strong>Order Total</strong>
                                            <div class="float-right"><span>Rs</span><span>
                                              {{ number_format($total_price,2) }}
                                            </span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!-- <a href="checkoutpage.html" class="uk-button checkout float-right">Place Order</a> -->
                                    <button type="submit" id="submit_order_form" class="uk-button checkout float-right">Place Order</button>
                                 </div>
                            </div>
                        </div>
                </div>
            </div>
        </form>
        </section>
        <!--  End category -->

@endsection
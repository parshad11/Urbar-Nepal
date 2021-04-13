@extends('ecommerce.layouts.master')
@section('title', 'User Account' )
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

    <section class="account-info">
      <h2 class="my-4 w-100 text-center"><i class="fas fa-user-circle"></i> Account Information</h2>

      <div class="w-75 mx-auto my-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true"> <b>Information</b></a>
          </li>
          <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false"><b>Wish List</b></a>
          </li> -->
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
              aria-selected="false"><b>Orders</b></a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="border p-4">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$customer->name}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$customer->email}}
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  (239) 816-9029
                </div>
              </div> -->
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Mobile</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                {{$customer->mobile}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Country</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                {{$customer->country}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">State</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                {{$customer->state}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">City</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                {{$customer->city}}
                </div>
              </div>
              <hr>
              <!-- <button class="btn btn-success mt-5">Edit</button> -->
              <a class="btn btn-success mt-5" href="{{route('customer.account_edit')}}">Edit</a>
            </div>
          </div>

          <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <div class="row">
              <div class="col-md-12">
                <div class="card card-body">
                  <div
                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="http://127.0.0.1:5500/img/logo-main.png" alt="">
                    </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">Title of Product</a>
                      </h6>

                      <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">Rs 250</h3>
                      <button type="button" class="btn btn-success mt-4 text-white"><i class="icon-cart-add mr-2"></i>
                        Add to cart</button>
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-md-12">
                <div class="card card-body">
                  <div
                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="http://127.0.0.1:5500/img/logo-main.png" alt="">
                    </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">Title of Product</a>
                      </h6>

                      <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">Rs 250</h3>
                      <button type="button" class="btn btn-success mt-4 text-white"><i class="icon-cart-add mr-2"></i>
                        Add to cart</button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-12">
                <div class="card card-body">
                  <div
                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="http://127.0.0.1:5500/img/logo-main.png" alt="">
                    </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">Title of Product</a>
                      </h6>

                      <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">Rs 250</h3>
                      <button type="button" class="btn btn-success mt-4 text-white"><i class="icon-cart-add mr-2"></i>
                        Add to cart</button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-12">
                <div class="card card-body">
                  <div
                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="http://127.0.0.1:5500/img/logo-main.png" alt="">
                    </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">Title of Product</a>
                      </h6>

                      <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">Rs 250</h3>
                      <button type="button" class="btn btn-success mt-4 text-white"><i class="icon-cart-add mr-2"></i>
                        Add to cart</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div> -->

          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                @if(isset($orders))
                    @forelse($orders as $order)
                        @if(isset($order->sell_lines) && $order->sell_lines!=null)
                            @foreach($order->sell_lines as $order_item)
                            <div class="col-md-12">
                                <div class="card card-body">
                                <div
                                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="@foreach($order_item->variations->media as $media){{ $media->display_url }}@endforeach" alt="">
                                    </div>
                                    <div class="media-body">
                                    <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">
                                        {{$order_item->variations->product->name}}&nbsp;{{$order_item->variations->name != "DUMMY" ? $order_item->variations->name : ''}}
                                    </a>
                                    </h6>

                                    <!-- <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p> -->
                                    <span>Quantity : {{ $order_item->quantity }}&nbsp;{{$order_item->variations->product->unit->short_name}}</span><br>
                                    <span>Order date : {{\Carbon\Carbon::parse($order->transaction_date)->format('M d, Y')}}</span>

                                    </div>
                                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                    <h3 class="mb-0 font-weight-semibold">Rs {{ number_format($order->final_total,2) }}</h3>
                                    <div>
                                        <span><strong>Status :</strong></span>
                                        <span>{{ ($order->status =='draft') ? 'Pending' : 'Accepted'}}</span><br>
                                        <span><strong>Delivery Status:</strong></span>
                                        <span>{{($order->delivery)?@ucwords($order->delivery->delivery_status):'Not Assigned'}}</span>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </div>
                            @endforeach
                        @endif
                    @empty
                    @endforelse
                @endif
              <!-- <div class="col-md-12">
                <div class="card card-body">
                  <div
                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0 col-md-2"> <img src="http://127.0.0.1:5500/img/logo-main.png" alt="">
                    </div>
                    <div class="media-body">
                      <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">Title of Product</a>
                      </h6>

                      <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>

                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                      <h3 class="mb-0 font-weight-semibold">Rs 250</h3>
                      <div>
                        <span><strong>Status :</strong></span>
                        <span>Delivered</span>
                      </div>
                    </div>
                  </div>
                </div>

              </div> -->
            </div>
          </div>

        </div>
      </div>


    </section>


@endsection

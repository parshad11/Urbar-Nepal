@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
@endsection
@section('content')
<div class="container checkout">
    <div class="row" style="padding-top:25px; padding-bottom:25px;">
      <div class="col-md-12">
        <div id="mainContentWrapper">
          <div class="col-md-8 col-md-offset-2">
            <h2 style="text-align: center;">
              Review Your Order &amp; Complete Checkout
            </h2>
            <hr>
            <a href="#" class="btn btn-info" style="width: 100%;">Add More Products &amp; Services</a>
            <hr>
            <div class="shopping_cart">
              <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">Review
                          Your Order</a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
                        <div class="items">
                          <div class="col-md-9">
                            <table class="table table-striped">

                              <tbody>
                                  @forelse ($cart_items as $item)
                                      
                                <tr>
                                    <td>
                                      <ul>
                                        <li><b>{{$item->variation->product->name}}&nbsp;{{$item->variation->name != 'DUMMY' ? $item->variation->name : '' }}</b></li>
                                        <li>Quantity : <span>{{$item->quantity}}</span></li>
                                        <li>Rate : <span>Rs: {{$item->variation->sell_price_inc_tax }}</span></li>
    
                                      </ul>
                                    </td>
    
                                    <td>
                                      <b>Rs.{{$item->total_price}}</b>
                                    </td>
                                    </tr>
                                  @empty
                                      
                                  @endforelse
                            </tbody></table>
                          </div>
                          <div class="col-md-3">
                            <div style="text-align: center;">
                              <h3>Order Total</h3>
                              <h3><span style="color:green;">Rs :{{$total_sum}}</span></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" style="background: none; border: none;">
                    <h4 class="panel-title">
                      <div style="text-align: center; width:100%;"><a style="width: 100%; display: none;" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-success" onclick="$(this).fadeOut(); $('#payInfo').fadeIn();" aria-expanded="true">Continue
                          to Billing Information»</a></div>
                    </h4>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true">Contact
                        and Billing Information</a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="panel-body">

                      <table class="table table-striped" style="font-weight: bold;">
                        <tbody><tr>
                          <td style="width: 175px;">
                            <label for="id_email">Email:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_email" name="email" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_first_name">First name:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_first_name" name="first_name" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_last_name">Last name:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_last_name" name="last_name" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_address_line_1">Address:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_address_line_1" name="address_line_1" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_address_line_2">Unit / Suite #:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_address_line_2" name="address_line_2" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_city">City:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_city" name="city" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_state">State:</label>
                          </td>
                          <td>
                            <select class="form-control" id="id_state" name="state">
                              <option value="p1">Pradesh 1</option>
                              <option value="p2">Pradesh 2</option>
                              <option value="p3">Pradesh 3</option>
                              <option value="p4">Pradesh 4</option>
                              <option value="p5">Pradesh 5</option>


                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_postalcode">Postalcode:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_postalcode" name="postalcode" required="required" type="text">
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 175px;">
                            <label for="id_phone">Phone:</label>
                          </td>
                          <td>
                            <input class="form-control" id="id_phone" name="phone" type="text">
                          </td>
                        </tr>

                      </tbody></table>
                    </div>

                    <div class="panel-heading" style="background: none; border: none;">
                      <h4 class="panel-title">
                        <div style="text-align: center; width:100%;"><a style="width:100%;" data-toggle="collapse" data-parent="#accordion" href="" class=" btn btn-success">Place an Order</a>
                        </div>
                      </h4>
                    </div>
                  </div>


                </div>


            </form></div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
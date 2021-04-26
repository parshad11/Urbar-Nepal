@extends('ecommerce.layouts.master')
@section('title', 'User Account' )
@section('content')

<!--  category -->
<section id="product_request">
      <div class="container py-5 my-2 bg-white">
        <div class="row ">
          <div class="form-horizontal">
            <legend>Edit Account</legend>
            <form action="{{ url('/shop/user-account-update/'.$customer->id) }}" method="post">
            @csrf
              <div class="form-group ">
                <label for="name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{$customer->email}}" class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="phone">Mobile</label>
                <input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                  class="form-control" name="mobile" value="{{$customer->mobile}}" required>
              </div>
              <div class="form-group ">
                <label for="Country">Country</label>
                <input type="text" name="country" id="country" placeholder="Eg. Nepal" class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="reference">Province</label>
                <input type="text" name="state" id="state"
                  placeholder="Eg. 3"
                  class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="reference">ZIP Code</label>
                <input type="text" name="zip_code" id="zip_code"
                  placeholder="Eg. 44600"
                  class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="reference">Landmark</label>
                <input type="text" name="address_line_1" id="address_line_1"
                  placeholder="Landmark"
                  class="form-control" required>
              </div>
              <div class="form-group ">
                <label for="pro_specification">City</label>
                <textarea name="city" id="pro_specification" cols="100" rows="1" class="form-control"
                  placeholder="Eg. Kathmandu" required></textarea>
              </div>
              <input type="submit" name="submit" value="Submit Request" class="uk-button view-cart">
            </form>
          </div>
        </div>
      </div>
    </section>

@endsection


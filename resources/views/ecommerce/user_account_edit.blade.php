@extends('ecommerce.layouts.master')
@section('title', 'User Account' )
@section('content')

<!--  category -->
<section id="product_request">
      <div class="container py-5 my-2 bg-white">
        <div class="row ">
          <div class="form-horizontal">
            <legend>Request Product Form</legend>
            <form action="" method="post">
              <div class="form-group ">
                <label for="name">Name*</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control">
              </div>
              <div class="form-group ">
                <label for="email">Email*</label>
                <input type="email" name="email" id="email" placeholder="Example@gmail.com" class="form-control">
              </div>
              <div class="form-group ">
                <label for="phone">Mobile*</label>
                <input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                  class="form-control" name="phone" placeholder="Enter valid phone number (only Nepal)">
              </div>
              <div class="form-group ">
                <label for="Country">Country*</label>
                <input type="text" name="Country" id="Country" placeholder="Enter product Country" class="form-control">
              </div>
              <div class="form-group ">
                <label for="reference">State</label>
                <input type="text" name="state" id="state"
                  placeholder="Enter State"
                  class="form-control">
              </div>
              <div class="form-group ">
                <label for="pro_specification">City*</label>
                <textarea name="city" id="pro_specification" cols="100" rows="1" class="form-control"
                  placeholder="Enter City"></textarea>
              </div>
              <input type="submit" name="submit" value="Submit Request" class="uk-button view-cart">
            </form>
          </div>
        </div>
      </div>
    </section>

@endsection

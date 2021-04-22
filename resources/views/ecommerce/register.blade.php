@extends('ecommerce.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <link rel="stylesheet" href="{{asset('cms/css/shop.css')}}">
    <style>
        .error_msg{
            font-size: 14px;
            font-weight: 300!important;
            color: red;
            background: #f2f9fd75;
        }
    </style>
@endsection
@section('content')
 <!-- Account Start -->
 <section class="account-area jarallax overlay-white">
    <img class="jarallax-img" src="images/bg/6.jpg" alt="">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="tab">
            <!-- Nav tabs -->

            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible alert-sm" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error !&nbsp;</strong>{{Session::get('error')}},&nbsp;Try Again
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="form_register">
  <div id="form_register">
                        <!-- @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('success')}}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('failed')}}
                            </div>
                        @endif -->
      <!-- You only need this form and the form-register.css -->
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <form class="form-register" method="post" action="{{route('registerCustomer')}}">
      {{ csrf_field() }}
        <div class="form-register-with-email">

          <div class="form-white-background">

            <div class="form-title-row">
              <h1>Create an account</h1>
            </div>

            <div class="form-row">
              <label>
                <span>Name</span>
                <input class="uk-input" type="text" name="name">
              </label>
            </div>

            <div class="form-row">
              <label>
                <span>Email</span>
                <input class="uk-input" type="email" name="email">
              </label>
            </div>

            <div class="form-row">
              <label>
                <span>Password</span>
                <input class="uk-input" type="password" name="password">
              </label>
            </div>
            <div class="form-row">
              <label>
                <span>Phone</span>
                <input class="uk-input" type="number" name="phone">
              </label>
            </div>
            <div class="form-row">
              <label>
                <span>address</span>
                <input class="uk-input" type="text" name="address">
              </label>
            </div>


            <div class="mb">
              <label for=""> <input type="checkbox" class="uk-checkbox" name="checkbox" checked>
                I agree to the <a href="#">terms and conditions</a></label>

            </div>

            <div class="form-row">
              <button type="submit" class="center uk-button view-cart">Register</button>
            </div>
            <a href="{{route('front_login')}}" class="form-log-in-with-existing">Already have an account? Login here
              &rarr;</a>

          </div>


        </div>

        <!-- <div class="form-sign-in-with-social">

          <div class="form-row form-title-row">
            <span class="form-title">Sign in with</span>
          </div>

          <a href="#" class="form-google-button">Google</a>
          <a href="#" class="form-facebook-button">Facebook</a>
          <a href="#" class="form-twitter-button">Twitter</a>

        </div> -->

      </form>

    </div>


    </section>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
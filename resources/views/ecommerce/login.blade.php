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
  <section id="form_login">
      <form class="form-login" method="post" action="{{route('post_front_login')}}">
      {{ csrf_field() }}
        <div class="form-log-in-with-email">

          <div class="form-white-background">

            <div class="form-title-row">
              <h1>Log in</h1>
            </div>

            <div class="form-row">
              <label>
                <span>Email</span>
                @if ($errors->has('email'))
                    <p class="error_msg">
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                    @endif
                <input type="email" name="email">
              </label>
            </div>

            <div class="form-row">
              <label>
                <span>Password</span>
                @if ($errors->has('password'))
                    <p class="error_msg">
                        <strong>{{ $errors->first('password') }}</strong>
                    </p>
                    @endif
                <input type="password" name="password">
              </label>
            </div>

            <div class="form-row">
              <button type="submit" class="uk-button view-cart center">Log in</button>
            </div>
            <a href="forget.html" class="form-forgotten-password">Forgotten password &middot;</a>
            <a href="{{route('registerr_user')}}" class="form-create-an-account">Create an account &rarr;</a>

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

    </section>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
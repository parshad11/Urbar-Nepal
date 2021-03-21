@extends('frontcms.layouts.master')
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
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#Section1" role="tab" data-toggle="tab">sign in</a></li>
              {{-- <li role="presentation"><a href="#Section2" role="tab" data-toggle="tab">sign up</a></li> --}}
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabs">
              <div class="tab-pane fade in active" id="Section1">
                <form class="form-horizontal" method="POST" action="{{route('post_front_login')}}">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    @if ($errors->has('email'))
                    <p class="error_msg">
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                    @endif
                    <input class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" type="email">
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    @if ($errors->has('password'))
                    <p class="error_msg">
                        <strong>{{ $errors->first('password') }}</strong>
                    </p>
                    @endif
                    <input class="form-control" name="password" id="exampleInputPassword1" type="password">
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-default">Sign in</button>
                  </div>
                  {{-- <div class="form-group forgot-pass">
                    <a href="#">forgot your password?</a>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
    <script src="{{asset('cms/js/shop.js')}}"></script>
@endsection
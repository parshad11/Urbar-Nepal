@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
    <style>
        /* BUY SELL */
        .buysell {
            background-image: url('https://images.unsplash.com/photo-1498491480129-04f6d95c90be?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=750&q=80');
            background-repeat: no-repeat;
            object-fit: cover;
            background-size: cover;
            height: 70vh;
            width: 100%;
            position: relative;
        }

        .buyer-seller-overlay {
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            background: rgb(0 0 0 / 40%);
            height: 100%;
            width: 100%;
        }

        .buyer-seller-overlay > div {
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #ffffff;
            padding: 2% !important;
            left: 0;
            right: 0;

        }

        .buyer-seller-overlay > div h2,
        h1 {
            color: #ffffff;
            padding-top: 2%;
        }

        .buyer-seller-overlay > div a {
            background: #d72027;
            color: #fff;
            border: none;
            margin-top: 2%;
            font-size: 18px;
            padding: 1% 2%;
        }

        .buysell-txt {
            height: 100vh;
            padding-top: 6%;

        }

        .buysell-txt p {
            width: 60%;
            margin: auto;
            text-align: justify;

            font-size: 20px;

        }

        .buysell-nav-section {
            padding: 2% 6%;
            display: flex;
            margin: 1% 0%;
        }

        .buysell-nav-section div {
            text-align: center;
            padding: 4% 2%;
            margin: auto;
            color: #ffffff;

        }

        .buysell-nav-section div a {
            font-size: 16px;
            background: #cc4232;
            color: #ffffff;
            border: none;
            padding: 2% 4%;
            border-radius: 25px;
        }

        .buysell-nav-section div p {
            width: 80%;
            font-size: 18px;
        }

        .buysell-nav-section h3 {
            color: #ffffff;
        }

        .buysell-nav-section .sell {

            background: #4a9e4a;

        }

        .buysell-nav-section .buy {

            background: #2393d1;
        }

        @media only screen and (max-width: 1024px) {

            .buysell-txt p {
                width: 80%;
            }
        }

        @media only screen and (max-width: 991px) {
            .buysell-nav-section div {
                margin: 0 auto;

            }
        }

        @media only screen and (max-width: 767px) {

            .buysell-nav-section {
                flex-direction: column;
            }

            .buysell-nav-section div {
                margin: 1% 0;
            }
        }
    </style>
@endsection
@section('content')

    <section class="buysell">
        <div class="buyer-seller-overlay">
            <div class="overlay-text text-center">
                <h2>Better Food, Better Life</h2>

                <h1> Let's Join the Revolution</h1>
                <a class="btn btn-success" href="#buysell-nav">JOIN NOW</a>
            </div>
        </div>
    </section>


    <section class="buysell-txt sell-buy" id="buysell-nav">
        <p>
            <b>FreshKTM</b> works with the most dedicated farmers around Nepal, We support farmers to make their farm as
            a
            finest growing area ensuring the best quality produce for our end consumers.
        </p>

        <div class="buysell-nav-section row">
            <div class="col-md-4 sell">
                <h3>Sell Your Fresh Produce</h3>
                <p>If you are dedicated farmer, We will invest on you and collect your production from your farm.</p>
                <br><br>
                <a href="{{ url('/#contact_us') }}" class="btn btn-primary">Sell With Us</a>

            </div>

            <div class="col-md-4 buy">
                <h3>Buy With Us</h3>

                <p>We are well equipped with the infrastructure required for fresh produce supply chain
                    with advanced technologies.</p> <br><br>
                <a href="{{ route('shop') }}" class="btn btn-primary">Buy With Us</a>

            </div>
        </div>
    </section>
@endsection
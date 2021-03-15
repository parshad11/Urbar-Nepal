<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link href="{{ asset('cms/images/fresh-favicon.png') }}" rel="shortcut icon" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('cms/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('cms/css/style.css') }}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{ asset('cms/css/responsive.css') }}" rel="stylesheet">

    @yield('styles')
    <style>
        /* MOBILE NAV */
        .navbar-header .logo-main {
            display: none;
        }

        .navbar-header .contact {
            display: none;
        }


        @media only screen and (max-width: 767px) {
            .my-search-box{
                display: none;
            }

            .header-topbar {
                display: none;
            }

            .header-middle {
                display: none;
            }

            .navbar-header .logo-main {
                display: block;
                position: absolute;
                width: 35%;
                height: auto;
                padding: 2%;
                left: -10%;
            }

            .navbar-header .contact {
                width: 100%;
                text-align: center;
                position: absolute;
                padding: 3%;
                display: block;
                left: 0;
                right: 0;

            }

            .navbar-header .contact a {
                color: #ffffff;

            }

            .navbar-header button{
                right: 0;
                position: absolute;

            }

            .navbar-collapse{
                margin-top: 15%;
            }

        }
        @media only screen and (max-width: 991px) {
            .col-md-2.quote_div{
                display: none!important;
            }
        }

        /* MAIN BANNER IMAGE */
        .main-banner {
            width: 100%;
        }

        /* APPs LINK */
        .apps-link-main {
            text-align: center;
        }

        .apps-link {
            display: flex;
        }

        .apps-link a {
            width: 25%;
            margin: auto;
        }
        @media (max-width: 768px){
            .col-md-2.col-sm-12.col-xs-12.full-wd480.appstore{
                display: none;
            }
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Main Header start -->
    <header class="main-herader">
        @include('frontcms.partials.header')

        @include('frontcms.partials.navbar')
    </header>

    @yield('content')

    @include('frontcms.partials.footer')

    <!-- modernizr -->
    <script src="{{ asset('cms/js/modernizr-2.6.2.min.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('cms/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('cms/js/bootstrap.min.js') }}"></script>

    <!-- All Included JavaScript -->
    <script src="{{ asset('cms/js/bootstrap-dropdownhover.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery-scrolltofixed-min.js') }}"></script>
    <script src="{{ asset('cms/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('cms/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery.ripples.js') }}"></script>
    <script src="{{ asset('cms/js/dyscrollup.js') }}"></script>
    <script src="{{ asset('cms/js/VideoPlayerPopUp.js') }}"></script>
    <script src="{{ asset('cms/js/animated-text.js') }}"></script>
    <script src="{{ asset('cms/js/jquery.zoomslider.min.js') }}"></script>
    <script src="{{ asset('cms/js/YouTubePopUp.jquery.js') }}"></script>
    <script src="{{ asset('cms/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('cms/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('cms/js/jquery.filterizr.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('cms/js/main.js') }}"></script>

    @yield('scripts')

</body>

</html>
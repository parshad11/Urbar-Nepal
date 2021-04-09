<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Urbar Nepal</title>

    <link rel="shortcut icon" href="{{ asset('ecom/img/logo-main.png')}} " type="image/x-icon">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ asset('ecom/css/bootstrap.min.css') }}">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/7989320092.js" crossorigin="anonymous"></script>

    <!-- owl css -->
    <link rel="stylesheet" href="{{ asset('ecom/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ecom/css/owl.theme.default.min.css') }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ asset('ecom/css/uikit.min.css') }}" />

    <link href="{{ asset('ecom/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- include  css/js -->
    <link rel="stylesheet" href="{{ asset('ecom/css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('ecom/css/metisMenu.min.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('ecom/css/animate.min.css') }}">
    <!-- Xzoom -->

    <!--  google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla|Rubik" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('ecom/css/app.min.css') }}">


</head>

<body>


    <div class="uk-offcanvas-content">
        <!-- header -->
        @include('ecommerce.partials.header')
        <!-- END OF HEADER -->

        @yield('content')


        <!-- FOOTER -->
        <!-- START OF FOOTER -->
        @include('ecommerce.partials.footer')

        <!-- END OF FOOTER -->


        <footer id="mini-footer">
            <p>Powered by <a href="" style="color: #d3232a"> Next Nepal</a></p>
        </footer> <!-- EOF FOOTER -->
    </div>

    <script src="{{ asset('ecom/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('ecom/js/popper.min.js') }}"></script>
    <script src="{{ asset('ecom/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('ecom/js/jquery.min.js') }}"></script>
    <script src="{{ asset('ecom/js/jquery-ui.js') }}"></script>

    <!-- UIkit JS -->
    <script src="{{ asset('ecom/js/uikit.min.js') }}"></script>

    <script src="{{ asset('ecom/js/uikit-icons.min.js') }}"></script>

    {{-- <script src="{{ asset('ecom/js/ionicons.js') }}"></script> --}}
    <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>

    <!-- Owl carousel -->
    <script src="{{ asset('ecom/js/owl.carousel.min.js') }}"></script>

    <!-- metis menu -->
    <script src="{{ asset('ecom/js/metisMenu.js') }}"></script>
    <script src="{{ asset('ecom/js/modernizr.min.js') }}"></script>

    <!-- custom scroll -->
    <script src="{{ asset('ecom/js/slick.min.js') }}"></script>
    @stack('scripts')

    <!-- CUSTOM JS -->
    <script src="{{ asset('ecom/js/app.min.js') }}"></script>
    <script src="{{ asset('ecom/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('ecom/js/new.js') }}"></script>

@yield('scripts')

<script>
    $(".lazy_load_image").lazyload({
	    effect : "fadeIn"
	});
    function showFrontendAlert(type, message) {
        if (type == 'danger') {
            type = 'error';
        }
        Swal.fire({
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 1500
        })
    }
    function updateNavCart() {
        $.get('{{ route('cart.nav_cart') }}', {_token: '{{ csrf_token() }}'}, function (data) {
            $('#cart_count').html(data);
        });
    }
</script>
<script>
    $(document).ready(function () {
        updateNavCart();
        $('#add_to_cart, #add_to_carts').on('click', function () {
            var quantity = $('.input_quantity').val();
            var product_id = $(this).attr('product_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{route("addtocart")}}',
                data: {
                    product_id: product_id,
                    quantity: quantity
                },
                success: function (response) {
                    if (response.status == 'error') {
                        showFrontendAlert('warning', response.msg);
                    } else {
                        // var cart_number = response.data.length;
                        // alert (cart_number);
                        // $('#cart_count').text(cart_number);
                        updateNavCart();
                        showFrontendAlert('success', response.msg);
                    }
                },
                error: function (response) {
                    console.log(response);
                    if (response.responseJSON.error=="Unauthenticated.") {
                        window.location.href = document.location.origin + '/ecommerce/login';
                    }
                }
            });
        });
        $(this).on('click','.remove-product', function (e) {
            var cart_id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '{{route("removefromcart")}}',
                data: {
                    cart_id: cart_id
                },
                success: function (response) {
                    updateNavCart();
                    $('#cart_item_detail').html(response);
                    showFrontendAlert('success', 'Product has been removed from cart successfully');
                },
                error: function (response) {
                    console.log('error');
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        });
    });
</script>
</body>

</html>
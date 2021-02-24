<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Favicon -->
    <link href="<?php echo e(asset('cms/images/favicon.png'), false); ?>" rel="shortcut icon" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('cms/css/bootstrap.min.css'), false); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo e(asset('cms/css/style.css'), false); ?>" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="<?php echo e(asset('cms/css/responsive.css'), false); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('styles'); ?>

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
        <?php echo $__env->make('frontcms.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('frontcms.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('frontcms.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- modernizr -->
    <script src="<?php echo e(asset('cms/js/modernizr-2.6.2.min.js'), false); ?>"></script>

    <!-- jQuery -->
    <script src="<?php echo e(asset('cms/js/jquery.min.js'), false); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(asset('cms/js/bootstrap.min.js'), false); ?>"></script>

    <!-- All Included JavaScript -->
    <script src="<?php echo e(asset('cms/js/bootstrap-dropdownhover.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery-scrolltofixed-min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/owl.carousel.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jarallax.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery.countup.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery.waypoints.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery.ripples.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/dyscrollup.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/VideoPlayerPopUp.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/animated-text.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery.zoomslider.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/YouTubePopUp.jquery.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/lightbox.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/imagesloaded.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('cms/js/jquery.filterizr.min.js'), false); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo e(asset('cms/js/main.js'), false); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/layouts/master.blade.php ENDPATH**/ ?>
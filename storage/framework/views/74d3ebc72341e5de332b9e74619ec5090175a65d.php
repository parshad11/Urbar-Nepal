<!-- Header topbar start -->
<div class="header-topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-6 col-xs-12">
                <div class="herader-topbar-col tobar-leftside center767">
                    <p>Welcome To Freshktm</p>
                </div>
            </div>
            <div class="col-lg-5 col-sm-6 col-xs-12">
                <div class="herader-topbar-col tobar-rightside center767">
                    <ul>
                        <?php
                            $result = json_decode($home_settings->social_links, true);
                            // $social_link = explode(",",$home_settings->social_links);
                            // foreach($social_link as $key => $value){
                            //     list($k, $v) = explode('=', $value);
                            //     $result[ $k ] = $v;
                            // }
                        ?>
                        <li><a href="<?php echo e($result['facebook'], false); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo e($result['twitter'], false); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo e($result['linkedin'], false); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo e($result['google'], false); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Middle -->
<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12 full-wd480">
                <div class="header-middle-col main-logo">
                   <a href="<?php echo e(route('front_dashboard'), false); ?>"><img src="<?php echo e(asset('uploads/img/home/'.$home_settings->logo_image), false); ?>" alt=""></a>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-6 full-wd480">
                <div class="header-middle-col my-info-box">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <h4>Mail</h4>
                    <p><?php echo e(isset($home_settings->email) ? $home_settings->email : '', false); ?></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 full-wd480">
                <div class="header-middle-col my-info-box">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <h4>Phone Number</h4>
                    <p><?php echo e(isset($home_settings->phone) ? $home_settings->phone : '', false); ?></p>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 full-wd480">
                <div class="header-middle-col quote-box">
                    <a href="#quote" id="scroll">Get a quote</a>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/partials/header.blade.php ENDPATH**/ ?>
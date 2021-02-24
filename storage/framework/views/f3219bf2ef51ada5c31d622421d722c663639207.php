<?php $__env->startSection('title', 'Freshktm | Fresh Market And Agro ecommorce platform' ); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Banner Start -->
<section class="slider-area jarallax overlay-black">
    <?php
        $banner_images= explode(',',$home_setting->banner_images);
    ?>
    <div id="slider" data-zs-src='[
        <?php if(isset($banner_images[0])): ?>  
        "<?php echo e(asset('uploads/img/home/'.$banner_images[0]), false); ?>"
        <?php endif; ?>
        ,"<?php echo e(asset('uploads/img/home/'.$banner_images[0]), false); ?>"
        <?php if(isset($banner_images[1])): ?>  
        ,"<?php echo e(asset('uploads/img/home/'.$banner_images[1]), false); ?>"
        <?php endif; ?>
        <?php if(isset($banner_images[2])): ?> 
        ,"<?php echo e(asset('uploads/img/home/'.$banner_images[2]), false); ?>"
        <?php endif; ?>
        ]' data-zs-bullets="false" data-zs-interval="8000" data-zs-switchSpeed="800" data-zs-interval="4500" data-zs-overlay="false" data-zs-autoplay="true">
        <div class="slider-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="slider-col slider-ontext">
                            <h1>Start your business with <span>freshktm<span></h1>
                            <h3 class="cd-headline clip">
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">We are very experienced</b>
                                    <b>we are very trusted</b>
                                    <b>Be happy with us</b>
                                </span>
                            </h3>
                            <div class="slider-buttons">
                                <a class="btn btn-default theme-btn btn-hover" href="#">Shop Now</a>
                                <a class="btn btn-default theme-btn btn-hover" href="contact.html">Become a Partner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Start -->
<section class="features-area bg-shape">
    <?php
        $why_text = json_decode($home_setting->why_choose_us, true);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>why choose us</h2>
                    <div class="title-border"></div> 
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-network-locked"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Agriculture Leader</h3>
                            <p class="description">
                                <?php echo e($why_text['Agriculture Leader'], false); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-badge-check"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Quality Standards</h3>
                            <p class="description">
                                <?php echo e($why_text['Quality Standards'], false); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                <div class="features-col">
                    <div class="features-box">
                        <div class="features-icon">
                            <i class="zmdi zmdi-thumb-up"></i>
                        </div>
                        <div class="features-content">
                            <h3 class="title">Organic Service</h3>
                            <p class="description">
                                <?php echo e($why_text['Organic Service'], false); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Start -->
<section class="about-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-col">
                    <h2>Welcome to <span>Freshktm</span></h2>
                    <h4>More than 12 years of experience</h4>
                    <p><?php echo e($home_setting->welcome_description, false); ?></p>
                    <p>Morbi scelerisque volutpat egestas. Fusce dapibus rutrum magna, id pharetra lectus consectetur quis. Nunc ut porta enim, ac vulputate nisl. Vivamus sit amet dui quis leo suscipit scelerisque. Suspendisse euismod magna nec justo aliquam, tincidunt luctus mauris ultricies.</p>
                    <a class="btn btn-default theme-btn btn-hover" href="#" role="button">Join Us</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-col">
                    <img src="<?php echo e(asset('uploads/img/home/'.$home_setting->welcome_image), false); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section section-default jarallax overlay-black">
    <img class="jarallax-img" src="<?php echo e(asset('uploads/img/home/'.$home_setting->vdo_image), false); ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="video-col">
                    <h2>Let's see a quick video</h2>
                    <a class="bla-2 hvr-ripple-out" href="<?php echo e($home_setting->vdo_link, false); ?>">
                        <i class="fa fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Start -->
<section class="service-area bg-shape">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>our Services</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(isset($services) && !empty($services)): ?>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6 col-xs-6 fw600">
                    <div class="service-col">
                        <div class="service-img">
                            <?php if(isset($service->service_image) && !empty($service->service_image) && file_exists(public_path().'/uploads/img/home/services/'.$service->service_image)): ?>
                            <img src="<?php echo e(asset('uploads/img/home/services/'.$service->service_image), false); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="service-content">
                            <h3><a href="#"><?php echo e($service->title, false); ?></a></h3>
                            <p><?php echo e($service->summary, false); ?></p>
                            <span></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Call Start -->
<section class="call-area jarallax overlay-black">
    <img class="jarallax-img" src="<?php echo e(asset('uploads/img/home/'.$home_setting->call_section_image), false); ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="call-box call-number">
                    <h1>we are ready to receive your call</h1>
                    <h2><i class="zmdi zmdi-headset-mic"></i><?php echo e($home_setting->phone, false); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Start -->
<section class="team-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">
                    <h2>Meet Our Team</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            <?php $__currentLoopData = $team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="our-team">
                    <div class="pic">
                    <?php if(isset($team_member->member_image) && !empty($team_member->member_image) && file_exists(public_path().'/uploads/img/home/team/'.$team_member->member_image)): ?>
                        <img src="<?php echo e(asset('uploads/img/home/team/'.$team_member->member_image), false); ?>" alt="">                        
                    <?php endif; ?>
                    </div>
                    <div class="team-content">
                        <h3 class="title"><a href="team-single.html"><?php echo e($team_member->name, false); ?></a></h3>
                        <span class="post"><?php echo e($team_member->post, false); ?></span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-skype"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Counter Start -->
<section class="counter-area jarallax overlay-black" id="water-animation-two">
    <img class="jarallax-img" src="<?php echo e(asset('uploads/img/home/'.$home_setting->counter_section_image), false); ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">2082</span>
                    </div>
                    <h3 class="title">Happy Farmers</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">1920</span>
                    </div>
                    <h3 class="title">Happy Clients</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">380</span>
                    </div>
                    <h3 class="title">our staff</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="counter">
                    <div class="counter-content">
                        <span class="count">188</span>
                    </div>
                    <h3 class="title">Win Awards</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Start -->
<section class="gallery-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">
                    <h2>Other Services</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Filter Nav -->
                
                <div class="filtr-container">
                    <?php if(isset($services)): ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 filtr-item" data-category="3, 2" data-sort="value">
                        <div class="box">
                            <img src="<?php echo e(asset('uploads/img/home/services/'.$service->service_image), false); ?>" alt="">
                            <div class="box-content">
                                <h3 class="title"><?php echo e($service->title, false); ?></h3>
                                <ul class="icon">
                                    <li>
                                        <a href="<?php echo e(asset('uploads/img/home/services/'.$service->service_image), false); ?>" data-lightbox="lightbox" data-title="<?php echo e($service->title, false); ?>">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Request Start -->
<section class="request-area jarallax overlay-black quote" id="water-animation-three">
    <img class="jarallax-img" src="<?php echo e(asset('uploads/img/home/'.$home_setting->quote_background_image), false); ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="request-title">
                    <h2>Get a Quote</h2>
                </div>
               <form>
                    <div class="row">
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Your Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="email" class="form-control" id="inputEmail3" placeholder="Email Address">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Phone Numbar">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="request-col">
                               <input type="text" class="form-control" placeholder="Subject">
                           </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="request-col">
                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                <button class="btn btn-default theme-btn" type="submit">Send Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="request-col">
                    <img src="<?php echo e(asset('uploads/img/home/'.$home_setting->quote_front_image), false); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Start -->
<section class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>testimonial</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="testimonial-carousel">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="testimonial">
                        <div class="pic">
                            <img src="<?php echo e(asset('uploads/img/home/testimonials/'.$testimonial_info->image), false); ?>" alt="" class="img-responsive">
                        </div>
                        <h3 class="testimonial-title">
                            <?php echo e($testimonial_info->name, false); ?>

                            <small><?php echo e($testimonial_info->post, false); ?></small>
                        </h3>
                        <p class="description"><?php echo e($testimonial_info->comment, false); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>   
        </div>
    </div>
</section>

<!-- Blog Start -->
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2>Our Blog</h2>
                    <div class="title-border"></div> 
                    <p>Sed pellentesque, ligula at lacinia molestie sapien consequat</p>
                </div>
            </div>
            <?php if(isset($blogs)): ?>
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-sm-12">
                <div class="blog-box">
                    <div class="blog-img">
                        <img src="<?php echo e(asset('uploads/img/home/blogs/'.$blog->image), false); ?>" alt="">
                    </div>
                    <div class="blog-box-content">
                        <h4><?php echo e($blog->title, false); ?></h4>
                        <div class="time-date">
                            <ul>
                                
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> <a href="#"><?php echo e(\Carbon\Carbon::parse($blog->created_at)->format('M d, Y'), false); ?></a></li>
                                
                            </ul>
                        </div>
                        <p><?php echo e($blog->summary, false); ?><a href="<?php echo e(route('blog_single', $blog->slug), false); ?>">[Read More]</a></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Client start -->
<section class="client-area">
    <?php
        $client_images= explode(',',$home_setting->client_images);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="client-carousel">
                    <?php $__currentLoopData = $client_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <a href="#"><img src="<?php echo e(asset('uploads/img/home/'.$client_image), false); ?>" alt=""></a>
                    </div>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontcms.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/index.blade.php ENDPATH**/ ?>
<!-- Footer start -->
<section class="our-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="our-footer-col">
                    <div class="footer-title">
                        <h2>Recent post</h2>
                    </div>
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="our-post">
                        <img src="<?php echo e(asset('uploads/img/home/blogs/'.$blog->image), false); ?>" alt="">
                        <p><a href="<?php echo e(route('blog_single', $blog->slug), false); ?>"><?php echo e($blog->summary, false); ?></a></p>
                        <a href="javascript:;"><?php echo e(\Carbon\Carbon::parse($blog->created_at)->diffForHumans(), false); ?></a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>  
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="our-footer-col">
                    <div class="our-footer-logo">
                        <a href="<?php echo e(route('front_dashboard'), false); ?>"><img src="<?php echo e(asset('uploads/img/home/'.$home_settings->logo_image), false); ?>" alt=""></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed numquam hic nobis! Sint accusamus sapiente excepturi debitis corporis.</p>
                        <ul class="our-footer-social clearfix">
                            <?php
                                $result = json_decode($home_settings->social_links, true);
                            ?>
                            <li><a href="<?php echo e($result['facebook'], false); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo e($result['twitter'], false); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo e($result['linkedin'], false); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo e($result['google'], false); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="subscribe-area">
                        <div class="footer-title">
                            <h2>Subscribe for Newsletter</h2>
                        </div>
                        <form>
                            <div class="input-group">
                                <input placeholder="Email Address" class="form-control" name="search-field" type="text">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-hover">Subscribe</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="our-footer-col clearfix">
                    <div class="footer-title">
                        <h2>Quick contact</h2>
                    </div>
                    <div class="quick-contact">
                        <form id="ajax-contact" method="post" action="php/contact.php">
                            <div class="row">
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required=""> 
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control textarea-hight-full" id="message" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    <button class="btn btn-default theme-btn btn-hover" type="submit">Sent Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>


<!-- Copyright start from here -->
<div class="copyright">
    <div class="row">
        <div class="col-md-12">
            <div class="copyright-col text-center">
                <p>Copyright ©2021 <a href="https://freshktm.com" target="_blank">freshktm</a> All Rights Reserved</p>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/partials/footer.blade.php ENDPATH**/ ?>
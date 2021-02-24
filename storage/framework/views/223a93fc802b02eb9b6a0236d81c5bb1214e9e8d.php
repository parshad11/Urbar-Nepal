<?php $__env->startSection('title', 'Freshktm | Fresh Market And Agro ecommorce platform' ); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('cms/js/google-map.js'), false); ?>"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdEPAHqgxFK5pioDAB3rsvKchAtXxRGO4&callback=initMap"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Page heading Start -->
<section class="page-heading-area jarallax overlay-black" id="water-animation">
    <img class="jarallax-img" src="<?php echo e(asset('uploads/img/home/about/'.$about_info->banner_image), false); ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-heading-col border-hover">
                    <h2>Contact</h2>
                    <p><a href="<?php echo e(route('front_dashboard'), false); ?>">Home</a> / <a href="<?php echo e(route('contact'), false); ?>">Contact</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Start -->
<section class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="contact-col contact-infobox">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <p><?php echo e($contact->email, false); ?></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="contact-col contact-infobox">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <p><?php echo e($contact->phone, false); ?></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="contact-col contact-infobox">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p>Address: <?php echo e($contact->address, false); ?></p>
                </div>
            </div>
        </div>
        <div class="row contact-form-row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="contact-col">
                        <div id="form-messages"></div>
                        <form id="ajax-contact" method="post" action="php/contact.php">
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email"  required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject" required>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-textarea">
                                    <textarea class="form-control" rows="6" placeholder="Wright Message" id="message" name="message" required></textarea>
                                    <button class="btn btn-default theme-btn btn-hover" type="submit" value="Submit Form">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="google-map-col">
                    <div id="map" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontcms.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/contact.blade.php ENDPATH**/ ?>
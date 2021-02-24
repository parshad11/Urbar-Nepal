<?php $__env->startSection('title', __('product.add_new_product')); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Home Page Settings</h1>
    
</section>

<!-- Main content -->
<section class="content">
<form action="<?php echo e(route('frontcms-settings.store'), false); ?>" class="form" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Logo Image :'), false); ?> </label><br>
                <small>Dimension :- 252*80</small>
            </div>
            <div class="col-md-10">
                <div id="logo">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="choose_us" class="control-label">Contact Details :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                </div>
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <input type="text" name="phone" class="form-control" placeholder="Contact Number/Phone...?" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding:0 10px 0 0;">
                    <input type="email" name="email" class="form-control" placeholder="Email Address..." required>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Banner Images :'), false); ?> </label>
                <small>Dimension :- 1920*1200</small>
            </div>
            <div class="col-md-10">
                <div id="photos">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Why Choose US :</label>
            </div>
            <div class="col-md-10">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Agriculture Leader" placeholder="Agriculture Leader" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Quality Standards" placeholder="Quality Standards" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Organic Service" placeholder="Organic Service" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Welcome Section :</label><br>
                <small>Dimension :- 820*725</small>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div id="welcome">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea name="welcome_description" id="welcome_description" cols="30" rows="5" class="form-control" placeholder="Welcome  Description Here..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="choose_us" class="control-label">Quick Video Section :</label><br>
            <small>Dimension :- 1920*1280</small>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div id="vdo_img">

                    </div>
                </div>
                <div class="col-md-12">
                    <input type="url" name="video_link" class="form-control" placeholder="YouTube Video Link...">
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Faq Section :</label>
            </div>
            <div class="col-md-10 faq_content_wrapper">
                <div class="row" style="margin-bottom: 10px" style="margin-bottom: 10px">
                    <div class="col-md-5">
                        <input type="text" name="faq[]"class="form-control" placeholder="Question...?">
                    </div>
                    <div class="col-md-6">
                        <textarea name="faq_ans[]" id="" cols="30" rows="5" class="form-control" placeholder="Answer..." style="resize: none;"></textarea>
                    </div>
                    <a href="javascript:void(0);" class="col-md-1 btn btn-sm btn-success faq_add_btn"><i class="fa fa-plus"></i>&nbsp;Add</a>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Social Links :</label>
            </div>
            <div class="col-md-10">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="facebook" class="form-control" placeholder="Facebook...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" class="form-control" placeholder="Facebook Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="twitter" class="form-control" placeholder="Twitter...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" class="form-control" placeholder="Twitter Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="linkedin" class="form-control" placeholder="LikedIn...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" class="form-control" placeholder="LikedIn Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="google" class="form-control" placeholder="Google+...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" class="form-control" placeholder="Google+ Link...?">
                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Google Map Link :'), false); ?> </label><br>
            </div>
            <div class="col-md-10" style="padding-left: 0;">
                    <input type="url" name="google_map_link" class="form-control" placeholder="Google Map Url...?" required>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Call Section Image :'), false); ?> </label><br>
                <small>Dimension :- 1920*855</small>
            </div>
            <div class="col-md-10">
                <div id="call_section">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Counter Section Image :'), false); ?> </label><br>
                <small>Dimension :- 1920*1278</small>
            </div>
            <div class="col-md-10">
                <div id="counter_section">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Quote Background Image :'), false); ?> </label><br>
                <small>Dimension :- 1920*1267</small>
            </div>
            <div class="col-md-10">
                <div id="quote_background">

                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Quote Front Image :'), false); ?> </label><br>
                <small>Dimension :- 800*948</small>
            </div>
            <div class="col-md-10">
                <div id="quote_foreground">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label"><?php echo e(__('Our Client Images :'), false); ?> </label><br>
                <small>Dimension :- 300*252</small>
            </div>
            <div class="col-md-10">
                <div id="clients">

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>


    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">  
                <button type="submit" value="submit" class="btn btn-primary submit_product_form">Save</button>
            </div>
        </div>
    </div>


</form>  
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('cms/spartan/dist/js/spartan-multi-image-picker-min.js'), false); ?>"></script>
    <script>
         $(document).ready(function(){

            $("#logo").spartanMultiImagePicker({
                fieldName:        'logo_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
            $("#photos").spartanMultiImagePicker({
                fieldName:        'banner_images[]',
                maxCount:         3,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#welcome").spartanMultiImagePicker({
                fieldName:        'welcome_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#vdo_img").spartanMultiImagePicker({
                fieldName:        'vdo_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#call_section").spartanMultiImagePicker({
                fieldName:        'call_section_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#counter_section").spartanMultiImagePicker({
                fieldName:        'counter_section_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#quote_background").spartanMultiImagePicker({
                fieldName:        'quote_back_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#quote_foreground").spartanMultiImagePicker({
                fieldName:        'quote_front_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $("#clients").spartanMultiImagePicker({
                fieldName:        'client_images[]',
                rowHeight:        '180px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
         });
    </script>
    <script>
        $(document).ready(function() {
            // Faq Add/Remove
            var wrapper = $(".faq_content_wrapper");
            var add_button = $(".faq_add_btn");

            var x = 0;
            $(add_button).click(function(e) {
                e.preventDefault();
                x++;
                var field = '<div class="row" style="margin-bottom: 10px" style="margin-bottom: 10px">' +
                                '<div class="col-md-5">' + 
                                    '<input type="text" name="faq[]" class="form-control" placeholder="Question...?">' +
                                '</div>' +
                                '<div class="col-md-6">' +
                                    '<textarea name="faq_ans[]" id="" cols="30" rows="5" class="form-control" placeholder="Answer..." style="resize: none;"></textarea>' +
                                '</div>' +
                                '<a href="" class="col-md-1 btn btn-sm btn-danger faq_remove_btn"><i class="fa fa-minus"></i>&nbsp;Remove</a>' +
                            '</div>' ;
                $(wrapper).append(field);
            });

            $(wrapper).on("click", ".faq_remove_btn", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Project\FreshKtm\Freshktm-\resources\views/frontcms/create-setting-form.blade.php ENDPATH**/ ?>
@extends('layouts.app')
@section('title', 'Edit Home Settings')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
@endsection

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Home Page Settings</h1>
    {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> --}}
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('frontcms-settings.update', $setting->id) }}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- logo image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Logo Image :')}} </label><br>
                <small>Dimension :- 252*80</small>
            </div>
            <div class="col-md-10">
                <div id="logo">                                      
                    @if ($setting->logo_image != null && file_exists(public_path().'/uploads/img/home/'.$setting->logo_image))
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img src="{{ asset('uploads/img/home/'.$setting->logo_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_logo_image" value="{{ $setting->logo_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endcomponent
    {{-- contact details --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="choose_us" class="control-label">Contact Details :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <input type="text" name="address" class="form-control" value="{{$setting->address}}" placeholder="Address" required>
                </div>
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <input type="text" name="phone" class="form-control" value="{{$setting->phone}}" placeholder="Contact Number/Phone...?" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding:0 10px 0 0;">
                    <input type="email" name="email" class="form-control" value="{{$setting->email}}" placeholder="Email Address..." required>
                </div>
            </div>
        </div>
    </div>
    @endcomponent
    {{-- Banner Images --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Banner Images :')}} </label>
                <small>Dimension :- 1920*1200</small>
            </div>
            <div class="col-md-10">
                <div id="photos">
                    @if ($setting->banner_images != null)
                    @php
                       $banner_images = explode(',', $setting->banner_images);
                    @endphp
                        @foreach ($banner_images as $banner_image)
                            @if(file_exists(public_path().'/uploads/img/home/banner/'.$banner_image))
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="img-upload-preview" style="margin-bottom: 10px;">
                                    <img src="{{ asset('uploads/img/home/banner/'.$banner_image) }}" alt="" class="img-responsive">
                                    <input type="hidden" name="previous_banner_images[]" value="{{ $banner_image }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endcomponent
    {{-- Why Choose Us --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Why Choose US :</label>
            </div>
            <div class="col-md-10">
                @if($setting->why_choose_us != null)
                @php
                    $why_us = json_decode($setting->why_choose_us, true);
                @endphp
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Benifits for Farmers" placeholder="Benifits for Farmers" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;">{{$why_us['Benifits for Farmers']}}</textarea>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Benifits for Retailers" placeholder="Benifits for Retailers" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;">{{$why_us['Benifits for Retailers']}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="why_title[]" value="Saving for Consumers" placeholder="Saving for Consumers" readonly>
                    </div>
                    <div class="col-md-9">
                        <textarea name="why_description[]" id="" cols="30" rows="5" class="form-control" style="resize: none;">{{$why_us['Saving for Consumers']}}</textarea>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endcomponent
    {{-- Welcome Section --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Welcome Section :</label><br>
                <small>Dimension :- 820*725</small>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div id="welcome">                                      
                            @if ($setting->welcome_image != null)
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="img-upload-preview">
                                        <img src="{{ asset('uploads/img/home/'.$setting->welcome_image) }}" alt="" class="img-responsive">
                                        <input type="hidden" name="previous_welcome_image" value="{{ $setting->welcome_image }}">
                                        <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea name="welcome_description" id="editor">{!!$setting->welcome_description!!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
    {{-- Quick Video Section --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="choose_us" class="control-label">Quick Video Section :</label><br>
            <small>Dimension :- 1920*1280</small>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div id="vdo_img">                                      
                        @if ($setting->vdo_image != null)
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img src="{{ asset('uploads/img/home/'.$setting->vdo_image) }}" alt="" class="img-responsive">
                                    <input type="hidden" name="previous_vdo_image" value="{{ $setting->vdo_image }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="url" name="video_link" value="{{$setting->vdo_link}}" class="form-control" placeholder="YouTube Video Link...">
                </div>
            </div>
        </div>
    </div>
    @endcomponent
    {{-- Faq Section --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label for="choose_us" class="control-label">Faq Section :</label>
            </div>
            <div class="col-md-10 faq_content_wrapper">
                @if ($setting->faqs != null)
                @php
                    $faqs = json_decode($setting->faqs, true);
                    $last = array_key_last($faqs);
                @endphp
                @foreach($faqs as $key => $value)
                @if($last != $key)
                <div class="row" style="margin-bottom: 10px">                              
                    <div class="col-md-5">
                        <input type="text" name="faq[]" class="form-control" value="{{$key}}" placeholder="Question...?">
                    </div>
                    <div class="col-md-6">
                        <textarea name="faq_ans[]" id="" cols="30" rows="5" class="form-control" placeholder="Answer..." style="resize: none;">{{$value}}</textarea>
                    </div>
                </div>
                @else
                <div class="row" style="margin-bottom: 10px">                
                    <div class="col-md-5">
                        <input type="text" name="faq[]" value="{{$key}}" class="form-control" placeholder="Question...?">
                    </div>
                    <div class="col-md-6">
                        <textarea name="faq_ans[]" id="" cols="30" rows="5" class="form-control" placeholder="Answer..." style="resize: none;">{{$value}}</textarea>
                    </div>
                    <a href="javascript:void(0);" class="col-md-1 btn btn-sm btn-success faq_add_btn"><i class="fa fa-plus"></i>&nbsp;Add</a>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    @endcomponent
    {{-- Social Link Section --}}
    @component('components.widget', ['class' => 'box-primary'])
        @php
            $social_link = json_decode($setting->social_links, true);
        @endphp
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
                        <input type="url" name="sitelink[]" value="{{$social_link['facebook']}}" class="form-control" placeholder="Facebook Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="twitter" class="form-control" placeholder="Twitter...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" value="{{$social_link['twitter']}}" class="form-control" placeholder="Twitter Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="linkedin" class="form-control" placeholder="LikedIn...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" value="{{$social_link['linkedin']}}" class="form-control" placeholder="LikedIn Page Link...?">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-4" style="padding:0 10px 0 0;">
                        <input type="text" name="site[]" value="google" class="form-control" placeholder="Google+...?" readonly>
                    </div>
                    <div class="col-md-8" style="padding:0 10px 0 0;">
                        <input type="url" name="sitelink[]" value="{{$social_link['google']}}" class="form-control" placeholder="Google+ Link...?">
                    </div>
                </div>
            </div>
        </div>
    @endcomponent

    {{-- google Map link --}}
    {{-- @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Google Map Link :')}} </label><br>
            </div>
            <div class="col-md-10" style="padding-left: 0;">
                    <input type="url" name="google_map_link" class="form-control" value="{{$setting->google_map_link}}" placeholder="Google Map Url...?" required>
            </div>
        </div>
    @endcomponent --}}
    {{-- call section image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Call Section Image :')}} </label><br>
                <small>Dimension :- 1920*855</small>
            </div>
            <div class="col-md-10">
                <div id="call_section">                                      
                    @if ($setting->call_section_image != null)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img src="{{ asset('uploads/img/home/'.$setting->call_section_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_call_section_image" value="{{ $setting->call_section_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endcomponent
    {{-- counter section image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Counter Section Image :')}} </label><br>
                <small>Dimension :- 1920*1278</small>
            </div>
            <div class="col-md-10">
                <div id="counter_section">                                      
                    @if ($setting->counter_section_image != null)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img src="{{ asset('uploads/img/home/'.$setting->counter_section_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_counter_section_image" value="{{ $setting->counter_section_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endcomponent
    {{-- Quote section image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Quote Background Image :')}} </label><br>
                <small>Dimension :- 1920*1267</small>
            </div>
            <div class="col-md-10">
                <div id="quote_background">                                       
                    @if ($setting->quote_background_image != null)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img src="{{ asset('uploads/img/home/'.$setting->quote_background_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_quote_background_image" value="{{ $setting->quote_background_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Quote Front Image :')}} </label><br>
                <small>Dimension :- 800*948</small>
            </div>
            <div class="col-md-10">
                <div id="quote_foreground">                                      
                    @if ($setting->quote_front_image != null)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img src="{{ asset('uploads/img/home/'.$setting->quote_front_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_quote_front_image" value="{{ $setting->quote_front_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endcomponent

    {{-- Our Clients image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{__('Our Client Images :')}} </label><br>
                <small>Dimension :- 300*252</small>
            </div>
            <div class="col-md-10">
                <div id="clients">
                    @if ($setting->client_images != null)
                    @php
                       $client_images = explode(',', $setting->client_images); 
                    @endphp
                        @foreach ($client_images as $client_image)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="img-upload-preview" style="margin-bottom: 10px;">
                                <img src="{{ asset('uploads/img/home/'.$client_image) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_client_images[]" value="{{ $client_image }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endcomponent


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

@endsection
@section('javascript')
    <script src="{{ asset('cms/spartan/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
         $(document).ready(function(){
            $('#editor').summernote({
                height: 150,
            });
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
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-3").remove();
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
@endsection

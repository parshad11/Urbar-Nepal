@extends('layouts.app')
@section('title','About Us')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.ck-editor__editable_inline {
    min-height: 200px;
}
</style>
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>About Page Settings</h1>
    {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> --}}
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('frontcms_about_store') }}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- Banner image --}}
    @component('components.widget', ['class' => 'box-primary'])
        <div class="row form-group">
            <div class="col-md-2">
                <label class="control-label">{{ ('Banner Image :')}} </label><br>
                <small>Dimension :- 1920*1278</small>
            </div>
            <div class="col-md-10">
                <div id="banner">
                    
                </div>
            </div>
        </div>
    @endcomponent
    {{-- Mission and Vision --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="mission_vision" class="control-label">Mission and Vision :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <textarea name="what_description" id="editor" required placeholder="Mission and Vision ..."></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding:0 10px 0 0;">
                    <label for="what_image" class="control-label"><small>Image Dimension: 820*725</small></label>
                    <div id="about_image_1">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcomponent
    {{-- Philosophy Section --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="why_us" class="control-label">Philosophy :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <textarea name="why_description" class="form-control" cols="30" rows="10" required placeholder="Philosophy Summary ..." style="resize: none;"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 points_content_wrapper">
                    <label for="philosophy" class="control-label">Philosophy Notes:</label>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-10" style="padding-left: 0;">
                            <input type="text" name="why_short_points[]" class="form-control" placeholder="Philosophy Notes...">
                        </div>
                        <a href="javascript:void(0);" class="col-md-1 btn btn-sm btn-success points_add_btn"><i class="fa fa-plus"></i>&nbsp;Add</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12" style="padding:0 10px 0 0;">
                    <label for="why_image" class="control-label"><small>Image Dimension: 600*630</small></label>
                    <div id="about_image_2">

                    </div>
                </div>
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

            $("#banner").spartanMultiImagePicker({
                fieldName:        'banner_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
            $("#about_image_1").spartanMultiImagePicker({
                fieldName:        'what_image[]',
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
            $("#about_image_2").spartanMultiImagePicker({
                fieldName:        'why_image[]',
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
         });
    </script>
    <script>
        $(document).ready(function() {
            // points Add/Remove
            var wrapper = $(".points_content_wrapper");
            var add_button = $(".points_add_btn");

            var x = 0;
            $(add_button).click(function(e) {
                e.preventDefault();
                x++;
                $(wrapper).append(`
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-10" style="padding-left: 0;">
                            <input type="text" name="why_short_points[]"class="form-control" placeholder="Philosophy Notes...">
                        </div>
                        <a href="javascript:void(0);" class="col-md-1 btn btn-sm btn-danger points_remove_btn"><i class="fa fa-minus"></i>&nbsp;Remove</a>
                    </div>`);
            });

            $(wrapper).on("click", ".points_remove_btn", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>
@endsection

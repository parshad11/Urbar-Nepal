@extends('layouts.app')
@section('title','Testimonial Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Testimonial Form</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('cms_testimonial_store')}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- <input type="hidden" name="setting_id"> --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="blog" class="control-label">Testimonial Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <label for="testi_image" class="control-label">Image Dimension :800*320</label>
                <div id="testi_img">

                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="name" class="control-label">Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Person Name..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="post" class="control-label">Person Post :</label>
                    <input type="text" name="post" class="form-control" placeholder="Person Post...(Manager)" required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="user_comment" class="control-label">Comment :</label>
                    <textarea name="comment" class="form-control" id="user_comment" cols="20" rows="10" style="resize: none;" placeholder="Person Comment..."></textarea>
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
    <script>
         $(document).ready(function(){

            $("#testi_img").spartanMultiImagePicker({
                fieldName:        'testimonial_image[]',
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
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-3").remove();
            });
         });
    </script>
@endsection

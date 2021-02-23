@extends('layouts.app')
@section('title','Service Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Service Form</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('cms_service_store')}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- <input type="hidden" name="setting_id"> --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="what_we_do" class="control-label">Service Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <label for="service_image" class="control-label">Image Dimension :400*280</label>
                <div id="service">

                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="team_name" class="control-label">Title :</label>
                    <input type="text" name="title" class="form-control" placeholder="Member Name..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="service_summary" class="control-label">Short Description :</label>
                    <textarea name="summary" class="form-control" id="service_summary" cols="20" rows="7" style="resize: none;"></textarea>
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

            $("#service").spartanMultiImagePicker({
                fieldName:        'service_image[]',
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

@extends('layouts.app')
@section('title', 'Home Setting')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Home Page Banners</h1>
    <small><b>Note*:</b>Every Field should be filled properly</small>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ route('ecom_banner_store') }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- logo image --}}
        @component('components.widget', ['class' => 'box-primary'])
            <div class="row form-group">
                <div class="col-md-2">
                    <label class="control-label">{{__('Banner Image :')}} </label><br>
                    <small>Dimension :- 512*512</small>
                </div>
                <div class="col-md-10">
                    <div id="banner">

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
    <script src="{{ asset('ecom/spartan/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
         $(document).ready(function(){
            $('#editor').summernote({
                height: 300,
            });
            
            $("#banner").spartanMultiImagePicker({
                fieldName:        'banner_image',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png|jpg|jpeg|bmp',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
         });
    </script>
@endsection

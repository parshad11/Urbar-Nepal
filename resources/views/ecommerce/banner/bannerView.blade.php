@extends('layouts.app')
@section('title', 'Home Setting')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Home Page Banners</h1>
    <!-- <small><b>Note*:</b>Every Field should be filled properly</small> -->
    <div class="mt-4">
         <a class="btn btn-primary submit_product_form" href="{{ url('/ecommerce/banners/create')}}">Add Banners</a>
    </div>
        
</section>

<!-- Main content -->

<!-- /.content -->


<section class="content">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Banner Image</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <th scope="row">{{$banner->id}}</th>
            <td><img src="{{ asset('uploads/img/home/banners/'.$banner->image) }}" width="300" height="100"></td>
            <td>
                <span class="badge label label-{{ $banner->status == 'active' ? 'success' : 'danger'}}">{{ $banner->status == 'active' ? 'Active' : 'Inactive'}}</span>
            </td>
            <td>
                <a class="btn btn-success submit_product_form" href="{{ url('/ecommerce/banners/edit/'.$banner->id)}}">Edit</a>
                <a class="btn btn-danger submit_product_form" href="{{ url('/ecommerce/banners/delete/'.$banner->id)}}">Delete</a>
            </td>
        </tr>
        
    @endforeach
    </tbody>
    </table>
</section>

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

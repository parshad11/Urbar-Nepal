@extends('layouts.app')
@section('title','Pages Setting')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Page Form</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('cms_pages_store')}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="blog" class="control-label">Page Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="title" class="control-label">Title :</label>
                    <input type="text" name="title" class="form-control" placeholder="Page Title..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="body" class="control-label">Page Content :</label>
                    <textarea name="body" class="form-control" id="editor" required></textarea>
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
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
         $(document).ready(function(){
            $('#editor').summernote({
                height: 300,
            });
         });
    </script>
@endsection

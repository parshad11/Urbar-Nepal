@extends('layouts.app')
@section('title','Career Setting')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Career Edit Form</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('cms_career_update', $career_setting->id)}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="blog" class="control-label">Page Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="title" class="control-label">Title :</label>
                    <input type="text" name="job_title" value="{{$career_setting->job_title}}" class="form-control" placeholder="Page Title..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="link" class="control-label">Form Link :</label>
                    <input type="url" name="form_link" value="{{$career_setting->form_link}}" class="form-control" placeholder="Form Link..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-2" style="padding:0 10px 0 0;">
                    <label for="page_status" class="control-label">Status :</label>
                    <select class="form-control" name="status" id="page_status">
                        <option value="" selected>-- Select Any --</option>
                        <option value="active" {{ isset($career_setting->status) && $career_setting->status == 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ isset($career_setting->status) && $career_setting->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="body" class="control-label">Job Description :</label>
                    <textarea name="job_description" class="form-control" id="editor" required>{!! $career_setting->job_description !!}</textarea>
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

@extends('layouts.app')
@section('title','Blog Setting')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blog Update Form</h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="{{ route('cms_blog') }}" class="btn btn-sm btn-success">Go Back</a><br><br>
<form action="{{ route('cms_blog_update', $blog_info->id)}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    {{-- <input type="hidden" name="setting_id"> --}}
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="blog" class="control-label">Blog Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <label for="blog_image" class="control-label">Image Dimension :800*320</label>
                <div id="blog_img">
                    @if (isset($blog_info->image) && !empty($blog_info->image) && file_exists(public_path().'/uploads/img/home/blogs/'.$blog_info->image))
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="img-upload-preview">
                            <img src="{{ asset('uploads/img/home/blogs/'.$blog_info->image) }}" alt="" class="img-responsive">
                            <input type="hidden" name="previous_blog_image" value="{{ $blog_info->image }}">
                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-4" style="padding:0 10px 0 0;">
                    <label for="category"class="control-label">Select Category :</label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-sitemap"></i>
						</span>
                        <select name="category_id" id="" class="form-control" required>
                            <option value="">-- Select Any Category --</option>
                            @if(isset($categories) && count($categories) > 0)
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}" {{ $item->id == $blog_info->category_id ? 'selected' : '' }}>{{$item->title}}</option>
                            @endforeach
                            @endif
                        </select>
					</div>
				</div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="title" class="control-label">Title :</label>
                    <input type="text" name="title" class="form-control" value="{{$blog_info->title}}" placeholder="Blog Title..." required>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-2" style="padding:0 10px 0 0;">
                    <label for="service_status" class="control-label">Status :</label>
                    <select class="form-control" name="status" id="service_status">
                        <option value="" selected>-- Select Any --</option>
                        <option value="active" {{ isset($blog_info->status) && $blog_info->status == 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ isset($blog_info->status) && $blog_info->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="blog_summary" class="control-label">Summary :</label>
                    <textarea name="summary" class="form-control" id="blog_summary" cols="20" rows="7" style="resize: none;" placeholder="Blog Summary...">{{$blog_info->summary}}</textarea>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="blog_description" class="control-label">Description :</label>
                    <textarea name="description" class="form-control" id="editor" required>{!!$blog_info->description!!}</textarea>
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

    {{-- <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#categoryModal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
        </div>
    </div> --}}
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
                height: 300,
            });

            $("#blog_img").spartanMultiImagePicker({
                fieldName:        'blog_image[]',
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

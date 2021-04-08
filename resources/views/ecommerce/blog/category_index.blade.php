@extends('layouts.app')
@section('title','Blog Category Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blog Category</h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="{{ route('ecom_blog_form') }}" class="btn btn-sm btn-success">Back to Blog</a><br><br>
<div class="row">
    <div class="col-md-4">
        <form action="{{ route('ecom_blogcat_store')}}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @component('components.widget', ['class' => 'box-primary'])
            <div class="row form-group">
                <label for="blog" class="control-label">Category Name :</label>

                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <input type="text" name="title" class="form-control" placeholder="Category Title..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">  
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form">Save</button>
                    </div>
                </div>
            </div>
            @endcomponent
        </form>
    </div>
    <div class="col-md-6">
        @component('components.widget', ['class' => 'box-primary'])

        <table class="table table-striped table-sm">
            <thead class="thead-light">
              <tr>
                <th>S.N</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($categories) && count($categories) > 0)
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$category->title}}</td>
                        <td>
                            <!-- <a href="{{ route('ecom_blogcat_edit', $category->id) }}" class="btn btn-sm btn-border-success"  data-toggle="modal" data-target="#categoryModal"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a> -->
                            <a href="{{ route('ecom_blogcat_delete', $category->id) }}" class="">Delete</a>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">No Data Found</td>
                </tr>
                @endif
            </tbody>
          </table>

          @endcomponent
    </div>
</div>
</section>
<!-- /.content -->

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('ecommerce.blog.category_form')
</div>

@endsection
@section('javascript')
    <script>
         $(document).ready(function(){

         });
    </script>
@endsection

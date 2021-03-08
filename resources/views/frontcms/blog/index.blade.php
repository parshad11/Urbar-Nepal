@extends('layouts.app')
@section('title','Blog Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blogs</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('cms_blog_form') }}" class="btn btn-sm btn-success">Add Blog</a>
          <hr>
            <table class="table table-striped table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                      @if(isset($blogs) && count($blogs) > 0)
                        @foreach ($blogs as $key => $value)
                            <tr>
                                <td>{{$key+$blogs->firstItem()}}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->summary }}</td>
                                <td>{{ $value->category->title}}</td>
                                <td><span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span></td>
                                <td>
                                    <a href="{{ route('cms_blog_edit',$value->id) }}" class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                </td>
                            </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="6">No Record Found</td>
                      </tr>
                      @endif
                </tbody>
              </table> 
              {{$blogs->links()}}
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

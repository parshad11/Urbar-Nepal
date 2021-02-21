@extends('layouts.app')
@section('title','Testimonial Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Testimonials</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('cms_testimonial_form') }}" class="btn btn-sm btn-success">Add testimonial</a>
          <hr>
            <table class="table table-striped table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Comment</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                      @if(isset($testimonials) && count($testimonials) > 0)
                        @foreach ($testimonials as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->post }}</td>
                                <td>{{ $value->comment }}</td>
                                <td>
                                    @if (isset($value->image) && !empty($value->image) && file_exists(public_path().'/uploads/img/home/testimonials/'.$value->image))
                                        <img src="{{ asset('uploads/img/home/testimonials/'.$value->image) }}" alt="" width="150px">                        
                                    @endif
                                </td>
                                <td><span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span></td>
                                <td>
                                    <a href="{{ route('cms_testimonial_edit',$value->id) }}" class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                </td>
                            </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="6">No Data Found</td>
                      </tr>
                      @endif
                </tbody>
              </table> 
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@extends('layouts.app')
@section('title','service Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>service Members</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('cms_service_form') }}" class="btn btn-sm btn-success">Add Service</a>
          <hr>
            <table class="table table-striped table-sm">
                <thead class="thead-light">
                  <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                      @if(isset($services) && count($services) > 0)
                        @foreach ($services as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->summary }}</td>
                                <td>
                                    @if (isset($value->service_image) && !empty($value->service_image) && file_exists(public_path().'/uploads/img/home/services/'.$value->service_image))
                                        <img src="{{ asset('uploads/img/home/services/'.$value->service_image) }}" alt="" width="150px">                        
                                    @endif
                                </td>
                                <td><span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span></td>
                                <td>
                                    <a href="{{ route('cms_service_edit',$value->id) }}" class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
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

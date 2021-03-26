@extends('layouts.app')
@section('title','Ecommerce File Setting')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>All Files</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('ecom_file_form') }}" class="btn btn-sm btn-success">Add File</a>
                <hr>
                <table class="table table-striped table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>S.N</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($files) && count($files) > 0)
                        @foreach ($files as $key => $value)
                            <tr>
                                <td>{{$key+$files->firstItem()}}</td>
                                <td>{{ $value->file_type }}</td>
                                <td>{{ $value->file_name }}</td>
                                <td>
                                    <a href="{{ route('cms_team_edit',$value->id) }}" class="btn btn-sm btn-border-primary"><i class="fa fa-eye"></i>&nbsp;View</a>
                                </td>
                                <td>
                                    <a href="{{ route('ecom_file_edit',$value->id) }}" class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                    <form action="{{route('ecom_file_delete', $value->id)}}" onsubmit="return confirm('Are You Sure To Delete This Member?')" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-border-danger"><i class="fa fa-trash"></i>Delete</button>
                                    </form>
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
                @isset($files)
                    {{$files->links()}}
                @endisset
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

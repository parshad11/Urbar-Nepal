@extends('layouts.app')
@section('title','Career Setting')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Careers</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('cms_career_form') }}" class="btn btn-sm btn-success">Add Career</a>
                <hr>
                <table class="table table-striped table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Form url</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($careers) && count($careers) > 0)
                        @foreach ($careers as $key => $value)
                            <tr>
                                <td>{{$key+$careers->firstItem()}}</td>
                                <td>{{ $value->job_title }}</td>
                                <td>{{ $value->form_link }}</td>
                                <td>
                                    <span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span>
                                </td>
                                <td>
                                    <a href="{{ route('cms_career_edit',$value->id) }}"
                                       class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                    <form action="{{route('cms_career_delete', $value->id)}}" method="post" onsubmit="return confirm('Are You Sure You Want To Delete?')" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-border-danger"><i class="fa fa-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No Record Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @isset($careers)
                    {{$careers->links()}}
                @endisset
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

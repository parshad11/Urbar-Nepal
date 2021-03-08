@extends('layouts.app')
@section('title','Pages Setting')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pages</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('cms_pages_form') }}" class="btn btn-sm btn-success">Add Page</a>
                <hr>
                <table class="table table-striped table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($pages) && count($pages) > 0)
                        @foreach ($pages as $key => $value)
                            <tr>
                                <td>{{$key+$pages->firstItem()}}</td>
                                <td>{{ $value->title }}</td>
                                <td>{!! substr($value->body,0 ,50) !!}</td>
                                <td>
                                    <span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span>
                                </td>
                                <td>
                                    <a href="{{ route('cms_pages_edit',$value->id) }}"
                                       class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                    <form action="{{route('cms_pages_delete', $value->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-border-danger"><i class="fa fa-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @isset($pages)
                    {{$pages->links()}}
                @endisset
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

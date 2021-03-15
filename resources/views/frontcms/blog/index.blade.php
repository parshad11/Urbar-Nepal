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
                        <th>Category</th>
                        <th>Image</th>
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
                                <td>{{ $value->category->title}}</td>
                                <td>
                                    @if($value->image != null && file_exists(public_path().'/uploads/img/home/blogs/'.$value->image))
                                        <img src="{{asset('uploads/img/home/blogs/'.$value->image)}}" alt=""
                                             height="100" class="img-fluid">
                                    @else
                                        <img src="{{asset('cms/images/blog/blog-2.jpg')}}" alt="" height="100"
                                             class="img-fluid">
                                    @endif
                                </td>
                                <td>
                                    <span class="badge label label-{{ $value->status == 'active' ? 'success' : 'danger'}}">{{ $value->status == 'active' ? 'Active' : 'Inactive'}}</span>
                                </td>
                                <td>
                                    <a href="{{ route('cms_blog_edit',$value->id) }}"
                                       class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i>&nbsp;Edit</a>
                                    <form action="{{route('cms_blog_delete', $value->id)}}"
                                          onsubmit="return confirm('Are You Sure To Delete This Blog?')" method="post"
                                          style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-border-danger"><i
                                                    class="fa fa-trash"></i>Delete
                                        </button>
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
                @isset($blogs)
                    {{$blogs->links()}}
                @endisset
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

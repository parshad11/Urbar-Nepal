@extends('layouts.app')
@section('title','Blog Setting')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Home Banners</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/ecommerce/banners/create')}}" class="btn btn-sm btn-success">Add Banner</a>
                <hr>
                <table class="table table-striped table-sm">
                    <thead class="thead-light">
                    <tr class='row'>
                        <th class='col-2'>S.N</th>
                        <th class='col-4'>Image</th>
                        <th class='col-3'>Status</th>
                        <th class='col-3'>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banners as $banner)
                    <tr class="row">
                        <th scope="row"  class="col-2">{{$banner->id}}</th>
                        <td class='col-4'><img src="{{ asset('uploads/img/home/banners/'.$banner->image) }}" width="300" height="100"></td>
                        <td class='col-3'>
                            <span class="badge label label-{{ $banner->status == 'active' ? 'success' : 'danger'}}">{{ $banner->status == 'active' ? 'Active' : 'Inactive'}}</span>
                        </td>
                        <td class='col-3'>
                            <a href="{{ url('/ecommerce/banners/edit/'.$banner->id)}}"  class="btn btn-sm btn-border-success"><i class="fa fa-paper-plane"></i> Edit</a>
                            <a href="{{ url('/ecommerce/banners/delete/'.$banner->id)}}"  class="btn btn-sm btn-border-danger"><i class="fa fa-paper-plane"></i>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                    @isset($banners)
                        {{$banners->links()}}
                    @endisset
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('ecom/spartan/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
         $(document).ready(function(){
            $('#editor').summernote({
                height: 300,
            });
            
            $("#banner").spartanMultiImagePicker({
                fieldName:        'banner_image',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png|jpg|jpeg|bmp',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
         });
    </script>
@endsection

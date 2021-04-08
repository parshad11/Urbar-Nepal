@extends('ecommerce.layouts.master')
@section('content')
<!-- BLOG START -->
<div class="blogs container">
    <div class="container text-center py-5">
      <div class="row">
        <h1 class="col-12 display-4">Blogs</h1>
        <p class=" col-md-8 mx-auto py-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere maxime perspiciatis fugiat ab magni repellat mollitia earum debitis, molestias, dignissimos nobis nemo excepturi sed dolorem consequuntur cum labore quis recusandae.</p>
      </div>
    </div>
    <div class="blogs-filter  pt-4">
      <button data-name="*" class="btn btn-success">ALL</button>
      @foreach($categories as $category)
      <button data-name=".{{$category->slug}}" class="btn">{{$category->title}}</button>
      <!-- <button data-name=".type-2" class="btn ">Category 2</button> -->
      @endforeach
    </div>
    <div class="grid row">
    @foreach($blogs as $blog)
      <div class="grid-item blogs-item col-lg-3 col-md-4 col-sm-6 py-2 {{ $blog->category->slug }}">
        <a href="{{route('blog_single',$blog->slug)}}">
          <div class="img">
            <img src="{{asset('uploads/img/home/blogs/'.$blog->image)}}" alt="" >
          </div>
          <div class="blog-box-content">
            <ul class="post-bar">
            <li>{{\Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</li>
            </ul>
          <div class="title"><b>{{$blog->summary}}</b>
          </div>
          <div class="summary"></div>
          <div class="">
          <a class="btn btn-default theme-btn btn-hover" href=""></a>
     </div>
     <a class="btn btn-default theme-btn btn-hover" href="{{ route('blog_single', $blog->slug) }}">Read More</a>
        </a>
      </div>
      </div>
      @endforeach      
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('ecom/js/isotope.pkgd.min.js') }}"></script>
@endpush
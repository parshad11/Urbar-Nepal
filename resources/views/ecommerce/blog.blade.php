@extends('ecommerce.layouts.master')
@section('content')
<!-- BLOG START -->

<div class="blogs container">


    <div class="container text-center py-5">
      <div class="row">
        <h1 class="col-12 display-4">Blogs</h1>
        <p class=" col-md-8 mx-auto py-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi tempore
          officia
          asperiores
          accusamus
          reprehenderit, nulla nisi autem ipsa porro quos voluptatum quod quis eligendi sapiente!</p>
      </div>
    </div>

    <div class="blogs-filter  pt-4">

      <button data-name="*" class="btn btn-success">ALL</button>
      <button data-name=".type-1" class="btn">Catefory 1</button>
      <button data-name=".type-2" class="btn ">Category 2</button>

    </div>

    <div class="grid row">

      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>

      <div class="grid-item type-2 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img
              src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>
      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>
      <div class="grid-item type-2 blogs-item col-lg-3 col-md-4 col-sm-6 py-2">

        <a href="blogsingle.htm">
          <div class="img">
            <img
              src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>

      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>

      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>

      <div class="grid-item type-2 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img
              src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>
      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>
      <div class="grid-item type-2 blogs-item col-lg-3 col-md-4 col-sm-6 py-2">

        <a href="blogsingle.htm">
          <div class="img">
            <img
              src="https://images.unsplash.com/photo-1555704574-f9ecf4717298?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
              alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>

      <div class="grid-item type-1 blogs-item col-lg-3 col-md-4 col-sm-6 py-2 ">

        <a href="blogsingle.htm">
          <div class="img">
            <img src="{{ asset('ecom/img/logo-main.png') }}" alt="">
          </div>

          <div class="title"><b>Lorem ipsum dolor sit amet.</b>

          </div>

          <div class="summary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, deserunt!</div>
        </a>
      </div>


    </div>

  </div>
@endsection
@push('scripts')
<script src="{{ asset('ecom/js/isotope.pkgd.min.js') }}"></script>
@endpush
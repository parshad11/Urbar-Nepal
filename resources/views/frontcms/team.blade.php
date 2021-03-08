@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('scripts')
@endsection
@section('content')
<!-- Page heading Start -->
<section class="page-heading-area jarallax overlay-black" id="water-animation">
    @if(isset($about_info))
    <img class="jarallax-img" src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
    @endif
</section>

<!-- Team Start -->
<section class="team-area">
    <div class="container">
        <div class="row">
            @if(count($teams) > 0)
            @foreach($teams as $team)
            <div class="col-md-3 col-sm-6 col-xs-6 fw600">
                <div class="our-team">
                    <div class="pic">
                        <img src="{{asset('uploads/img/home/team/'.$team->member_image)}}" alt="">
                    </div>
                    <div class="team-content">
                        <h3 class="title">{{ $team->name }}</h3>
                        <span class="post">{{$team->post}}</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-skype"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <nav class="pagination-outer" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a href="#" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a href="#" class="page-link" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>
@endsection
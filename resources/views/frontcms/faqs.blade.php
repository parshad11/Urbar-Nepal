@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Market And Agro ecommorce platform' )
@section('scripts')
@endsection
@section('content')
<!-- Page heading Start -->
<section class="page-heading-area jarallax overlay-black" id="water-animation">
    <img class="jarallax-img" src="{{asset('uploads/img/home/about/'.$about_info->banner_image)}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-heading-col border-hover">
                    <h2>FAQ</h2>
                    <p><a href="{{ route('front_dashboard') }}">Home</a> / <a href="{{route('faqs')}}">FAQ</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Faq Start -->
<section class="faq-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="my-faq-col">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @php
                            $faqs = json_decode($faq->faqs, true);
                            $count = count($faqs);
                            $first = array_key_first($faqs);
                        @endphp
                        @foreach($faqs as $key=>$value)
                        @php
                            $str=str_replace(' ', '', $key);
                        @endphp
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{$str}}">
                                <h4 class="panel-title">
                                    <a class="{{ ($first!=$key) ? 'collapsed' : ''}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$str}}" aria-expanded="true" aria-controls="collapse{{$str}}">
                                        {!! $key !!}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{$str}}" class="panel-collapse collapse {{ ($first==$key) ? 'in' : ''}}" role="tabpanel" aria-labelledby="heading{{$str}}">
                                <div class="panel-body">
                                    <p>{!! $value !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')

@section('title', __( 'delivery.view_delivery' ))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <h3>@lang( 'delivery.view_delivery' )</h3>
            </div>
        </div>
        <br>
        <div class="row">
        
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#task_details_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-info-circle" aria-hidden="true"></i> @lang( 'delivery.delivery_details')</a>
                        </li>
                        
                        <li>
                            <a href="#delivery_location_detail_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-map-marker" aria-hidden="true"></i> @lang('delivery.location_details')</a>
                        </li>
                        @can('task.assign')
                        <li>
                            <a href="#delivery_person_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-user" aria-hidden="true"></i> @lang('delivery.delivery_person_details')</a>
                        </li>
                        @endcan
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="task_details_tab">
                            <div class="row">
                                 <div class="col-md-3">
                                    <strong>@lang('delivery.business_location'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($delivery->transaction->location_id)
                                        {{ $delivery->transaction->location->name }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                             
                                    <div class="col-md-4">
                                    <strong>@lang('lang_v1.type'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($delivery->transaction_id)
                                        {{ $delivery->transaction->type}}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>
                                    <div class="col-md-3 ">
                                    <strong>@lang('delivery.payment_status'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($delivery->transaction_id)
                                        {{ $delivery->transaction->payment_status}}
                                        @else
                                        --
                                        @endif
                                    </p>
		
                                    </div>

                                    <div class="col-md-3 pull-right">
                                    <strong>@lang('delivery.delivery_status'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($delivery->delivery_status)
                                        {{ $delivery->delivery_status }}
                                        @else
                                        --
                                        @endif
                                    </p>
		
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-4">
                                    <strong>@lang('delivery.delivery_started_at'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($delivery->delivery_started_at)
                                        {{ $delivery->delivery_started_at }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.delivery_ended_at'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($delivery->delivery_ended_at)
                                        {{ $delivery->delivery_ended_at }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-4">
                                    <strong>@lang('delivery.delivered_to'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($delivery->delivered_to)
                                        {{ $delivery->delivered_to }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                    <strong>@lang('delivery.special_instructions'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($delivery->special_delivery_instructions)
                                        {{ $delivery->special_delivery_instructions }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>   
                                    <div class="col-md-4 pull-right">
                                    <strong>@lang('delivery.assigned_by'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($delivery->assigned_by)
                                        {{ $delivery->record_staff->user_name }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="delivery_location_detail_tab">
                            <div class="row">
                            <div class="col-md-12"   style="display:flex;justify-content: space-between;">
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.shipping_address'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                    @if($delivery->shipping_address)
                                        {{ $delivery->shipping_address }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-8 pull-right">
                                    <strong>@lang('delivery.location_view'):</strong><br>
                                    <input type="hidden" id="pickup_latitude" value="{{ $delivery->pickup_latitude }}" name="pickup_latitude">
                                    <input type="hidden" id="pickup_longitude" value="{{ $delivery->pickup_longitude }}" name="pickup_longitude">
                                    <div id='pickup_map'>
                                    
                                    </div> 
                                    </div>

                            </div>
                            <br/>
                            <div class="col-md-12"   style="display:flex;justify-content: space-between;">
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.pickup_address'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                    @if($delivery->pickup_address)
                                        {{ $delivery->pickup_address }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-8">
                                    <strong>@lang('delivery.location_view'):</strong><br>
                                    <input type="hidden" id="shipping_latitude" value="{{ $delivery->shipping_latitude }}" name="shipping_latitude">
                                    <input type="hidden" id="shipping_longitude" value="{{ $delivery->shipping_longitude }}" name="shipping_longitude">
                                    <div id='shipping_map'>
                                    
                                    </div> 
                                    </div>
                            </div>       
                        </div>
                         </div>

                        <div class="tab-pane" id="delivery_person_tab">
                        <div class="box box-primary">
                    <div class="box-body box-profile">
                       
                            @php
                            if(isset($task->delivery_person->user->media->display_url)) {
                                $img_src = $delivery->delivery_person->user->media->display_url;
                            } else {
                                $img_src = 'https://ui-avatars.com/api/?name='.$delivery->delivery_person->user->first_name;
                            }
                            @endphp

                        <img class="profile-user-img img-responsive img-circle" src="{{$img_src}}" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            {{$delivery->delivery_person->user->user_name}}
                        </h3>

                        <p class="text-muted text-center" title="@lang('user.role')">
                            {{$delivery->delivery_person->user->role_name}}
                        </p>

                        <ul class="list-group list-group-unbordered text-center">
                            <li class="list-group-item">
                                <b>@lang( 'business.contact_number' )</b>
                                <a>{{$delivery->delivery_person->user->contact_number}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang( 'business.email' )</b>
                                <a>{{$delivery->delivery_person->user->email}}</a>
                            </li>

                            <li class="list-group-item">
                                <b>{{ __('lang_v1.status_for_user') }}</b>
                                @if($delivery->delivery_person->user->status == 'active')
                                    <span class="label label-success pull-right">
                                        @lang('business.is_active')
                                    </span>
                                @else
                                    <span class="label label-danger pull-right">
                                        @lang('lang_v1.inactive')
                                    </span>
                                @endif
                            </li>
                        </ul>
                            
                                <a href="#" class="btn btn-primary btn-block">
                                    <i class="fas fa-thumbtack"></i>
                                    @lang("messages.track")
                                </a>
                           
                            
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
@endsection
@section('javascript')
    <!-- document & note.js -->
    @include('documents_and_notes.document_and_note_js')
   
    <script type="text/javascript">
        $(document).ready( function(){
            $('#user_id').change( function() {
                if ($(this).val()) {
                    window.location = "{{url('/users')}}/" + $(this).val();
                }
            });
        });

        mapboxgl.accessToken = 'pk.eyJ1IjoicHJhbW9kbGFtc2FsIiwiYSI6ImNqenp2d25xZjIyZnozbG1saXJvdzY4encifQ.JnhenWIopEkt6RAp5ukfCA';
        const delivery_pickup_latitude=$('input#pickup_latitude').val();
        const delivery_pickup_longitude=$('input#pickup_longitude').val();
        const delivery_shipping_latitude=$('input#shipping_latitude').val();
        const delivery_shipping_longitude=$('input#shipping_longitude').val();

        const delivery_pickup_map = new mapboxgl.Map({
            container: 'pickup_map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center:[delivery_pickup_longitude, delivery_pickup_latitude],
            zoom:13
        });

        var marker = new mapboxgl.Marker()
        .setLngLat([delivery_pickup_longitude, delivery_pickup_latitude])
        .addTo(delivery_pickup_map);

        delivery_pickup_map.addControl(new mapboxgl.NavigationControl());

        
        const delivery_shipping_map = new mapboxgl.Map({
            container: 'shipping_map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center:[delivery_shipping_longitude, delivery_shipping_latitude],
            zoom:13
        });

        var marker = new mapboxgl.Marker()
        .setLngLat([delivery_shipping_longitude, delivery_shipping_latitude])
        .addTo(delivery_shipping_map);

        delivery_shipping_map.addControl(new mapboxgl.NavigationControl());

    </script>
@endsection
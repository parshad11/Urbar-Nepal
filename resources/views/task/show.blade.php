@extends('layouts.app')

@section('title', __( 'delivery.view_task' ))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <h3>@lang( 'delivery.view_task' )</h3>
            </div>
        </div>
        <br>
        <div class="row">
           
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#task_details_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-info-circle" aria-hidden="true"></i> @lang( 'delivery.task_details')</a>
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
                                        @if($task->location_id)
                                        {{ $task->location->name }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                             
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.task_title'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->title)
                                        {{ $task->title }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>
                                    <div class="col-md-3 ">
                                    <strong>@lang('delivery.task_type'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->task_type)
                                        {{ $task->task_type}}
                                        @else
                                        --
                                        @endif
                                    </p>
		
                                    </div>

                                    <div class="col-md-3 pull-right">
                                    <strong>@lang('delivery.task_status'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->task_status)
                                        {{ $task->task_status }}
                                        @else
                                        --
                                        @endif
                                    </p>
		
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-4">
                                    <strong>@lang('delivery.task_started_at'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($task->started_at)
                                        {{ $task->started_at }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.task_ended_at'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($task->ended_at)
                                        {{ $task->ended_at }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-4">
                                    <strong>@lang('delivery.assigned_by'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray ">
                                        @if($task->assigned_by)
                                        {{ $task->record_staff->user_name }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-6">
                                    <strong>@lang('delivery.description'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->description)
                                        {{ $task->description }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-6">
                                    <strong>@lang('delivery.special_instructions'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->special_instructions)
                                        {{ $task->special_instructions }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>   
                                    <div class="col-md-12"   style="display:flex;justify-content: space-between;">

                                    </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="delivery_location_detail_tab">
                            <div class="row">
                            <div class="col-md-12"   style="display:flex;justify-content: space-between;">
                                    <div class="col-md-4">
                                    <strong>@lang('delivery.task_address'):</strong><br>
                                    <p class="well well-sm no-shadow bg-gray">
                                        @if($task->task_address)
                                        {{ $task->task_address }}
                                        @else
                                        --
                                        @endif
                                    </p>
                                    </div>

                                    <div class="col-md-8">
                                    <strong>@lang('delivery.location_view'):</strong><br>
                                    <div id='map'>
                                    
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
                                $img_src = $task->delivery_person->user->media->display_url;
                            } else {
                                $img_src = 'https://ui-avatars.com/api/?name='.$task->delivery_person->user->first_name;
                            }
                            @endphp

                        <img class="profile-user-img img-responsive img-circle" src="{{$img_src}}" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            {{$task->delivery_person->user->user_name}}
                        </h3>

                        <p class="text-muted text-center" title="@lang('user.role')">
                            {{$task->delivery_person->user->role_name}}
                        </p>

                        <ul class="list-group list-group-unbordered text-center">
                            <li class="list-group-item">
                                <b>@lang( 'business.contact_number' )</b>
                                <a>{{$task->delivery_person->user->contact_number}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang( 'business.email' )</b>
                                <a>{{$task->delivery_person->user->email}}</a>
                            </li>

                            <li class="list-group-item">
                                <b>{{ __('lang_v1.status_for_user') }}</b>
                                @if($task->delivery_person->user->status == 'active')
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
                            
                                <a href="{{action('TaskController@edit', [$task->delivery_person_id])}}" class="btn btn-primary btn-block">
                                    <i class="fas fa-thumbtack"></i>
                                    @lang("messages.track")
                                </a>
                           
                            
                        </div>
                    <!-- /.box-body -->
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
    <script src="{{ asset('js/map.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready( function(){
            $('#user_id').change( function() {
                if ($(this).val()) {
                    window.location = "{{url('/users')}}/" + $(this).val();
                }
            });
        });
        
mapboxgl.accessToken = 'pk.eyJ1IjoicHJhbW9kbGFtc2FsIiwiYSI6ImNqenp2d25xZjIyZnozbG1saXJvdzY4encifQ.JnhenWIopEkt6RAp5ukfCA';

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center:[85.416665, 27.6833306],
    zoom:13
});

var marker = new mapboxgl.Marker()
.setLngLat([30.5, 50.5])
.addTo(map);

map.addControl(new mapboxgl.NavigationControl());
    </script>
 
@endsection
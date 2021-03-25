@extends('layouts.app')
@section('title','Team Setting')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Team Member Update</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <a href="{{ route('cms_team') }}" class="btn btn-sm btn-success">Go Back</a><br><br>
        <form action="{{ route('cms_team_update', $member_info->id)}}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- <input type="hidden" name="setting_id"> --}}
            @component('components.widget', ['class' => 'box-primary'])
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="what_we_do" class="control-label">Member Info :</label>
                    </div>
                    <div class="col-md-10">
                        <div class="row" style="margin-bottom: 10px;">
                            <label for="social_links" class="control-label">Image Dimension :400*400</label>
                            <div id="member">
                                @if (isset($member_info->member_image) && !empty($member_info->member_image) && file_exists(public_path().'/uploads/img/home/team/'.$member_info->member_image))
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="img-upload-preview">
                                            <img src="{{ asset('uploads/img/home/team/'.$member_info->member_image) }}" alt="" class="img-responsive">
                                            <input type="hidden" name="previous_member_image" value="{{ $member_info->member_image }}">
                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6" style="padding:0 10px 0 0;">
                                <label for="team_name" class="control-label">Member Name :</label>
                                <input type="text" name="name" value="{{ isset($member_info->name) ? $member_info->name : '' }}" class="form-control" placeholder="Member Name..." required>
                            </div>
                            <div class="col-md-6" style="padding:0 10px 0 0;">
                                <label for="post" class="control-label">Member Post :</label>
                                <input type="text" name="post" value="{{ isset($member_info->post) ? $member_info->post : '' }}" class="form-control" placeholder="Post/Designation..." required>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-2" style="padding:0 10px 0 0;">
                                <label for="user_status" class="control-label">Status :</label>
                                <select class="form-control" name="status" id="user_status">
                                    <option value="" selected>-- Select Any --</option>
                                    <option value="active" {{ isset($member_info->status) && $member_info->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive" {{ isset($member_info->status) && $member_info->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                </select>
                                {{-- <input type="text" name="name" value="{{ isset($member_info->name) ? $member_info->name : '' }}" class="form-control" placeholder="Member Name..."> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding:0 10px 0 0;">
                                <label for="social_links" class="control-label">Social Links:</label>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            @php
                                $result = json_decode($member_info->social_links, true);
                            @endphp
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="social_name[]" class="form-control" value="facebook" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="social_link[]" class="form-control" value="{{ !empty($result['facebook']) ? $result['facebook'] : '' }}" placeholder="Facebook Link...">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="social_name[]" class="form-control" value="twitter" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="social_link[]" class="form-control" value="{{ !empty($result['twitter']) ? $result['twitter'] : '' }}" placeholder="Twitter Link...">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="social_name[]" class="form-control" value="linkedin" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="social_link[]" class="form-control" value="{{ !empty($result['linkedin']) ? $result['linkedin'] : '' }}" placeholder="LinkedIn Link...">
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form">Update</button>
                    </div>
                </div>
            </div>


        </form>
    </section>
    <!-- /.content -->

@endsection
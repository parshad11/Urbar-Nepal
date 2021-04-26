@extends('layouts.app')
@section('title', 'Home Setting')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Home Page Settings</h1>
        <small><b>Note*:</b>Every Field should be filled properly</small>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('homepage-setting.update',$setting->id) }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- logo image --}}
            @component('components.widget', ['class' => 'box-primary'])
                <div class="row form-group">
                    <div class="col-md-2">
                        <label class="control-label">{{__('Logo Image :')}} </label><br>
                        <small>Dimension :- 512*512</small>
                    </div>
                    <div class="col-md-10">
                        <div id="logo">
                            @if ($setting->logo_image != null && file_exists(public_path().'/uploads/img/home/'.$setting->logo_image))
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="img-upload-preview">
                                        <img src="{{ asset('uploads/img/home/'.$setting->logo_image) }}" alt="" class="img-responsive">
                                        <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endcomponent
            {{-- contact details --}}
            @component('components.widget', ['class' => 'box-primary'])
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="choose_us" class="control-label">Contact Details :</label>
                    </div>
                    <div class="col-md-10">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6" style="padding:0 10px 0 0;">
                                <input type="text" name="address" class="form-control" value="{{@$setting->address}}" placeholder="Address" required>
                            </div>
                            <div class="col-md-6" style="padding:0 10px 0 0;">
                                <input type="text" name="phone" class="form-control" value="{{@$setting->phone}}" placeholder="Contact Number/Phone...?" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="padding:0 10px 0 0;">
                                <input type="email" name="email" class="form-control" value="{{@$setting->email}}" placeholder="Email Address..." required>
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent

            {{-- Socail Links --}}
            @component('components.widget', ['class' => 'box-primary'])
                @php
                    $social_link = json_decode($setting->social_links, true);
                @endphp
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="choose_us" class="control-label">Social Links :</label>
                    </div>
                    <div class="col-md-10">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="site[]" value="facebook" class="form-control" placeholder="Facebook...?" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="sitelink[]" value="{{$social_link['facebook']}}" class="form-control" placeholder="Facebook Page Link...?">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="site[]" value="twitter" class="form-control" placeholder="Twitter...?" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="sitelink[]" class="form-control" value="{{$social_link['twitter']}}" placeholder="Twitter Page Link...?">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="site[]" value="instagram" class="form-control" placeholder="Instagram...?" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="sitelink[]" class="form-control" value="{{$social_link['instagram']}}" placeholder="Instagram Page Link...?">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding:0 10px 0 0;">
                                <input type="text" name="site[]" value="google" class="form-control" placeholder="Google+...?" readonly>
                            </div>
                            <div class="col-md-8" style="padding:0 10px 0 0;">
                                <input type="url" name="sitelink[]" value="{{$social_link['google']}}" class="form-control" placeholder="Google+ Link...?">
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent

            {{-- google Map link --}}
            @component('components.widget', ['class' => 'box-primary'])
                <div class="row form-group">
                    <div class="col-md-2">
                        <label class="control-label">{{__('Google Map Link :')}} </label><br>
                    </div>
                    <div class="col-md-10" style="padding-left: 0;">
                        <input type="url" name="google_map_link" value="{{@$setting->google_map_link}}" class="form-control" placeholder="Google Map Url...?">
                    </div>
                </div>
            @endcomponent

            {{-- About Content Section --}}
            @component('components.widget', ['class' => 'box-primary'])
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="choose_us" class="control-label">About Content :</label><br>
                    </div>
                    <div class="col-md-10" style="padding-left: 0;">
                        <textarea name="about_content" id="editor">{{@$setting->about_content}}</textarea>
                    </div>
                </div>
            @endcomponent

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form">Save</button>
                    </div>
                </div>
            </div>

        </form>
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

            $("#logo").spartanMultiImagePicker({
                fieldName:        'logo_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
        });
    </script>
@endsection

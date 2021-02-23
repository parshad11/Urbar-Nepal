@extends('layouts.app')
@section('title','Team Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Team Member Add</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('cms_team_store')}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
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

                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <label for="team_name" class="control-label">Member Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Member Name..." required>
                </div>
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <label for="post" class="control-label">Member Post :</label>
                    <input type="text" name="post" class="form-control" placeholder="Post/Designation..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding:0 10px 0 0;">
                    <label for="social_links" class="control-label">Social Links:</label>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-4" style="padding:0 10px 0 0;">
                    <input type="text" name="social_name[]" class="form-control" value="facebook" readonly>
                </div>
                <div class="col-md-8" style="padding:0 10px 0 0;">
                    <input type="url" name="social_link[]" class="form-control" placeholder="Facebook Link...">
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-4" style="padding:0 10px 0 0;">
                    <input type="text" name="social_name[]" class="form-control" value="twitter" readonly>
                </div>
                <div class="col-md-8" style="padding:0 10px 0 0;">
                    <input type="url" name="social_link[]" class="form-control" placeholder="Twitter Link...">
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-4" style="padding:0 10px 0 0;">
                    <input type="text" name="social_name[]" class="form-control" value="linkedin" readonly>
                </div>
                <div class="col-md-8" style="padding:0 10px 0 0;">
                    <input type="url" name="social_link[]" class="form-control" placeholder="LinkedIn Link...">
                </div>
            </div>
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
    <script src="{{ asset('cms/spartan/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    <script>
         $(document).ready(function(){

            $("#member").spartanMultiImagePicker({
                fieldName:        'member_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel: 'Drop Here',
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png Type file')
                }
            });
            $("#about_image_1").spartanMultiImagePicker({
                fieldName:        'what_image[]',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-3 col-sm-4 col-xs-6',
                maxFileSize:      '',
                dropFileLabel : "Drop Here",
                allowedExt: 'png|jpeg|jpg|bmp|gif',
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-3").remove();
            });
         });
    </script>
    <script>
        $(document).ready(function() {
            // points Add/Remove
            var wrapper = $(".points_content_wrapper");
            var add_button = $(".points_add_btn");

            var x = 0;
            $(add_button).click(function(e) {
                e.preventDefault();
                x++;
                $(wrapper).append(`
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-10" style="padding-left: 0;">
                            <input type="text" name="why_short_points[]"class="form-control" placeholder="Short Points...?">
                        </div>
                        <a href="javascript:void(0);" class="col-md-1 btn btn-sm btn-danger points_remove_btn"><i class="fa fa-minus"></i>&nbsp;Remove</a>
                    </div>`);
            });

            $(wrapper).on("click", ".points_remove_btn", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>
@endsection

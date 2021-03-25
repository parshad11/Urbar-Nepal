@extends('layouts.app')
@section('title','Ecommerce File Setting')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Team Member Add</h1>
</section>

<!-- Main content -->
<section class="content">
<form action="{{ route('ecom_file_store')}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @component('components.widget', ['class' => 'box-primary'])
    <div class="row form-group">
        <div class="col-md-2">
            <label for="what_we_do" class="control-label">File Info :</label>
        </div>
        <div class="col-md-10">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-2" style="padding:0 10px 0 0;">
                    <label for="file_type" class="control-label">File Type :</label>
                    <select class="form-control" name="file_type" id="file_type">
                        <option value="" selected>-- Select Any --</option>
                        <option value="banner">Banner</option>
                        <option value="catalogue">Catalogue</option>
                    </select>
                </div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="padding:0 10px 0 0;">
                    <label for="team_name" class="control-label">Choose File :</label>
                    <input type="file" name="file" class="form-control" required>
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

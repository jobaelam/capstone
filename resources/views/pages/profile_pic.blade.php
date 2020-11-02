@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Profile</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-4">
    <div class="box box-default">
      <div class="box-body">
        <div id="image-cropper">
          <div class="image-container">
            <img src="{{Auth::user()->profile_image}}" style="width: 285px; height: 285px; margin-left: 0px; margin-top: 0px; transform: none;">
          </div>
        </div><br>
        <div class="btn-group doc-actions pull-right">
          <button type="button" class="btn btn-info btn-md select-image-btn" title="Select Photo"><i class="fa fa-photo"></i> <span class="hidden-xs">Select</span></button>
          <button type="button" class="btn btn-danger btn-md save-image-btn" data-method="getCroppedCanvas"><i class="fa fa-save"></i> Save</span></button>  
        </div>
      </div>  
      <input type="file" class="inputImage" id="inputImage" name="file" accept="image/*" style="display:none"">
    </div>
  </div>
</div>
</div>
</div>

@stop
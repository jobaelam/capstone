@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Profile Picture</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-4">
    <div class="box box-default">
      <div class="box-body">
        <form action="{{ route('pages.StoreProfilePicture') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div id="image-cropper">
            <div class="image-container" id="imagePreview">
              <img src="{{ URL::asset('storage/avatar/'.$user->profile_image) }}" class="image-preview__image" style="display: block; max-width:285px;max-height:285px; width: auto; height: auto; margin-left: 0px; margin-top: 0px; transform: none; text-align: center">
            </div>
          </div><br>
          <div class="btn-group doc-actions pull-right">
            <input type="file" name="inpPicture" id="inpPicture" accept="image/*" class="hidden">
            <label for="inpPicture" class="btn btn-info btn-md select-image-btn" title="Select Photo"><i class="fa fa-photo"></i> <span class="hidden-xs">Select</span></label>
            <button type="submit" onClick="return empty()" class="btn btn-danger btn-md save-image-btn" data-method="getCroppedCanvas"><i class="fa fa-save"></i> Save</span></button>  
          </div>
        </form>
      </div>  
    </div>
  </div>
</div>
</div>
</div>

<script>
  const inpPicture = document.getElementById("inpPicture");
  const previewContainer = document.getElementById("imagePreview");
  const previewImage = previewContainer.querySelector(".image-preview__image");

  function empty() {
    var x;
    x = document.getElementById("inpPicture").value;
    if (x == "") {
        return false;
    };
  }

  inpPicture.addEventListener("change", function(){
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.addEventListener("load", function(){
        previewImage.setAttribute("src", this.result);
      });

      reader.readAsDataURL(file);
    }
    console.log(file);
  })

</script>

@stop
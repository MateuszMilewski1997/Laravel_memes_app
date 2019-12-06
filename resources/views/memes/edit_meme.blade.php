@extends('layouts.app')
@section('content')
<div class="container mt-5 form">
   @if(isset($message))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
   <div class="form-header">
      <h3>Edit meme</h3>
   </div>
   <form method="post" action="/meme/edit/title/{{ $meme->id}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group mt-4">
         <h4>Edit title</h4>
         <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{ $meme->title }}" required>
         <button class="btn btn-secondary w-100 mt-4">Save</button>
      </div>
   </form>
   <form method="post" action="/meme/edit/photo/{{ $meme->id }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group mt-5">
         <h4>Edit photo</h4>
         <div class="row">
            <div class="col-md-6 col-sm-12">
               <h5>Choose photo to upload</h5>
               <div>
                  <img style="width: 80%; height: auto;" class="form-img" id="blah" src="#" alt="your image" />
               </div>
               <div class="input-group mt-4">
                  <div class="input-group-prepend mt-4">
                     <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                  </div>
                  <div class="custom-file mt-4">
                     <input name="cover_image" type="file" onchange="readURL(this)" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                     <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
               </div>
               <button class="btn btn-secondary w-100 mt-5">Save</button>
            </div>
            <div class="col-md-6 col-sm-12">
               <h5>Old photo</h5>
               <img src="{{ asset('storage/cover_images/'.$meme->photoPath) }}" style="width: 80%; height: auto;" />
            </div>
         </div>
      </div>
   </form>
</div>
<script src="{{ asset('js/edit_meme.js') }}"></script>
@endsection
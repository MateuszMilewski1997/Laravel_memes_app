@extends('layouts.app')
@section('content')
<div class="container mt-5 form">
    <div class="form-header">
        <h3>Edit meme</h3>
    </div>
    <form>
        {{ csrf_field() }}
        <div class="form-group mt-4">
            <h4>Edit title</h4>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="{{ $meme->title }}">
                <button class="btn btn-secondary w-100 mt-3">Save</button>
        </div>
    </form>
    <form>
        {{ csrf_field() }}
        <div class="form-group mt-5">
            <h4>Edit photo</h4>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div><img style="width: 80%; height: auto;" class="form-img" id="blah" src="#" alt="your image" /></div>
                    <div class="input-group mt-4">
                        <div class="input-group-prepend mt-4">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file mt-4">
                            <input type="file" onchange="readURL(this)" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').css("display","block");
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
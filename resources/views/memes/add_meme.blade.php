@extends('layouts.app')
@section('content')

@section('content')
<div class="container mt-5" style="background-color:#fff; padding: 20px; border: 1px solid rgba(0, 0, 0, 0.125);">
    <div style="background-color:#fff; border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
        <h3>Create Post</h3>
    </div>
    {!! Form::open(['action' => 'MemesController@create', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group mt-5">
        <h4>{{Form::label('title', 'Title')}}</h4>
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        <div>
            <h4>{{Form::label('cover_image', 'Chose photo to upload')}}</h4>
        </div>
        <div>{{Form::file('cover_image', ['class'=>'btn btn-secondary', 'onchange'=>'readURL(this)'])}}</div>
        <img style="display: none; width: 150px; height: auto; margin-top: 30px; border-radius: 3px; border: 1px solid"
            id="blah" src="#" alt="your image" />
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="mt-5">
        {{Form::submit('Submit', ['class'=>'btn btn-secondary'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection

<script type="text/javascript">
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
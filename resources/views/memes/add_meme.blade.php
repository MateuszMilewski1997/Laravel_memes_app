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
        <div>{{Form::file('cover_image', ['class'=>'btn btn-secondary'])}}</div>
    </div>
    <div class="mt-5">
        {{Form::submit('Submit', ['class'=>'btn btn-secondary'])}}
    </div>
    {!! Form::close() !!}

</div>
{{--<form action="/meme/add/new" enctype="multipart/form-data" method="POST">
    <p>
        <label for="photo">
            <input type="file" name="photo" id="photo">
        </label>
    </p>
    <button>Upload</button>
    {{ csrf_field() }}
</form>--}}
@endsection
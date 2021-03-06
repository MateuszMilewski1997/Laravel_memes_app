@extends('layouts.app')
@section('content')
<div class="container mt-5 form">
   <div class="formHeader">
      <h3>Create meme</h3>
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
      <img class="formImg" id="blah" src="#" alt="your image" />
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
<script src="{{ asset('js/add_meme.js') }}"></script>
@endsection
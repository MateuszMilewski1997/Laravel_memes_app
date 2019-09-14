@extends('layouts.app')

@section('content')

@foreach ($memes as $meme)
    <p>This is user {{ $meme->title }}</p>
@endforeach

{{ $memes->links() }}

@endsection
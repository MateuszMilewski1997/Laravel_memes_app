@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($memes as $meme)

        <div class="card w-100 mt-5" style="width: 18rem;">
            <img src="{{ asset('photos/photo.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h1 class="card-title">Title</h1>
                <p class="card-text">
                <h3>{{ $meme->title }} id{{$meme->id}}</h3>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h3> <i class="far fa-clock"></i> : {{ $meme->created_at }}</h3>
                </li>
                @if(!isset($auth))
                <li class="list-group-item">
                    <h3> <i class="far fa-user"></i> : {{$meme->user->name}}</h3>
                </li>
                @endif
                <li class="list-group-item">
                    <h3> <i style="color:green;" class="far fa-thumbs-up"></i> {{ $meme->likes }}</h3>
                    @if(!isset($auth))
                    <button type="button" class="btn btn-outline-success w-100">Like</button>
                    @endif
                </li>
                <li class="list-group-item">
                    <h3> <i style="color:red;" class="far fa-thumbs-down"></i> {{ $meme->dislikes }}</h3>
                    @if(!isset($auth))
                    <button type="button" class="btn btn-outline-danger w-100">Dislike</button>
                    @endif
                </li>
                @if(isset($auth))
                <li class="list-group-item">
                <button onclick="getNumber(this.id)" id="{{ $meme->id }}" type="button" class="btn btn-lg btn-danger w-100" data-toggle="modal"
                        data-target="#exampleModal">Delete</button>
                </li>
                @endif
            </ul>
            <div class="card-body">
                <button class="btn btn-lg btn-secondary w-100">Show comments</button>
            </div>
        </div>

        @endforeach

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete mem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align:center;">
                        <h2><i class="fas fa-question"></i></h1>
                            <h3>Are you sure?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" onclick='deleteMem()' class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-5 d-flex justify-content-center"></div>
</div>

<script>

let number;

function getNumber(id)
{
    number = id;
}

function deleteMem()
{
    window.location.href = '/meme/delete/'.concat(number);
}

</script>

@endsection
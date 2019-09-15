@extends('layouts.app')
@section('content')
<div class="container">
        <button type="button" class="btn btn-primary w-100 mt-5 ">Waiting room</button>
    <div class="row">    
        @foreach ($memes as $meme)
                
                <div class="card w-100 mt-5" style="width: 18rem;">
                    <img src="{{ asset('photos/photo.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h1 class="card-title">Title</h1>
                        <p class="card-text">{{ $meme->title }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h3><i class="far fa-clock"></i> : {{ $meme->created_at }}</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><i class="far fa-user"></i> : email@email.com</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><i style="color:green;" class="far fa-thumbs-up"></i> {{ $meme->likes }}</h3>
                            <button type="button" class="btn btn-outline-success w-100">Like</button>
                        </li>
                        <li class="list-group-item">
                            <h3><i style="color:red;" class="far fa-thumbs-down"></i> {{ $meme->dislikes }}</h3>
                            <button type="button" class="btn btn-outline-danger w-100">Dislike</button>
                        </li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-lg btn-secondary w-100">Show mem</button>
                    </div>
                </div>

            @endforeach
            </div>
    <div class="mt-5 d-flex justify-content-center">{{ $memes->links() }}</div>
</div>

@endsection
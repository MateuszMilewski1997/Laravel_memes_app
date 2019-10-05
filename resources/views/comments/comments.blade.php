@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
    <div class="row">

        @foreach ($memes as $meme)
        <div class="card w-100 mt-5" style="width: 18rem;">
            <img src="{{ asset('storage/cover_images/'.$meme->photoPath) }}" class="card-img-top" alt="...">
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
                <li class="list-group-item">
                <form action="/meme/comment/add/{{ $meme->id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <button  class='btn btn-lg btn-primary w-100 mt-4 mb-3' type="submit">Add comment</button>
                    </form>
                </li>
                <li class="list-group-item">
                    <h2>Comments:</h2>
                    @if(isset($message))
                        <h3 class="mt-3">{{ $message }}</h3>
                    @endif
                    @foreach($comments as $comment)
                    <ol>
                        <div class="w-100 mb-2 mt-3"
                            style="background-color: #f8fafc; padding: 15px; border-radius: 5px; border: 1px solid lightgray">
                            <h4 class="mt-3">{{$comment->content}}</h4>
                            <h5 class="mt-3"><i class="far fa-calendar-alt"></i> {{$comment->created_at}}</h5>
                            @if(Auth::check() && Auth::user()->role == "admin")
                            <button type="button" class="btn btn-sm btn-danger">Delete comment</button>
                            @endif
                        </div>
                    </ol>
                    @endforeach
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center"></div>
</div>
@endforeach
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

function like(meme_id)
{
    
    let number_like = meme_id.toString();
    let class_like = "meme".concat(number_like);
    let content = document.querySelector(".".concat(class_like)).innerHTML;
    let insert = parseInt(content, 10);
    insert = insert + 1;
    let text = insert.toString();
    document.querySelector(".".concat(class_like)).innerHTML = text;

    $.ajax({
        url: "/meme/like/".concat(number_like),
        type: "GET",
    });
   
}

function dislike(meme_id)
{
    let number_like = meme_id.toString();
    let class_like = "dislike".concat(number_like);
    let content = document.querySelector(".".concat(class_like)).innerHTML;
    let insert = parseInt(content, 10);
    insert = insert + 1;
    let text = insert.toString();
    document.querySelector(".".concat(class_like)).innerHTML = text;

    $.ajax({
        url: "/meme/dislike/".concat(number_like),
        type: "GET",
    });
}

</script>

@endsection
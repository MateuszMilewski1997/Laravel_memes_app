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
                    @foreach($comments as $comment)
                        <ol>
                            {{$comment->content}}
                        </ol>
                    @endforeach
                    {{ $comments->links() }}
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
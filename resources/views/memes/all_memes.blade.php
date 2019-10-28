@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-9">
            @foreach ($memes as $meme)

            <div id="mem{{ $meme->id }}" class="card w-100 mt-5 meme">
                <div class="row">
                    <div class="col-5 ml-3 meme-title">
                        <h4>{{ $meme->title }}</h4>
                    </div>
                    <div class="col-5 meme-user">
                        <h5> <i class="far fa-user"></i> : {{$meme->user->name}}</h5>
                    </div>
                </div>
                <img src="{{ asset('storage/cover_images/'.$meme->photoPath) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    @if(isset(Auth::user()->role) && $meme->waiting_room == 1 && Auth::user()->role == "admin")
                    <button id="{{$meme->id}}" onclick="getNumber(this.id)" type="button" class="btn btn-warning w-100"
                        data-toggle="modal" data-target="#exampleModalLong">Change status</button>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <h3> <i class="far fa-thumbs-up meme-font-like"></i><span
                                        class="meme{{ $meme->id }}">{{ $meme->likes }}</span></h3>
                                @if(!isset($auth))
                                <button onclick="like(this.id)" id="{{ $meme->id }}" type="button"
                                class="btn btn-outline-success w-100 like{{ $meme->id }}">Like</button>
                                @endif
                            </div>
                            <div class="col-6">
                                <h3> <i class="far fa-thumbs-down meme-font-dislike"></i> <span
                                        class="dislike{{ $meme->id }}">{{ $meme->dislikes }}</span></h3>
                                @if(!isset($auth))
                                <button onclick="dislike(id)" id="{{ $meme->id }}" type="button"
                                    class="btn btn-outline-danger w-100 notlike{{ $meme->id }}">Dislike</button>
                                @endif
                            </div>
                        </div>
                    </li>
                    @if(isset($auth))
                    <li class="list-group-item">
                        <button onclick="getNumber(this.id)" id="{{ $meme->id }}" type="button"
                            class="btn btn-lg btn-danger w-100" data-toggle="modal"
                            data-target="#exampleModal">Delete</button>
                    </li>
                    <li class="list-group-item">
                        <button onclick="getNumber(this.id)" id="{{ $meme->id }}" type="button"
                            class="btn btn-lg btn-success w-100">Edit</button>
                    </li>
                    @endif
                </ul>
                <div class="card-body">
                    <a href="{{route('all_comments', $meme->id)}}"><button class="btn btn-lg btn-secondary w-100">Show
                            comments</button></a>
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
                        <div class="modal-body modal-delete">
                            <h2><i class="fas fa-question"></i></h1>
                                <h3>Are you sure?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick='deleteMem()' class="btn btn-danger" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center">
        {{ $memes->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Change status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body modal-status">
                <h2><i class="far fa-question-circle"></i></h2>
                <h3>Are you sure?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="changeStatus()" class="btn btn-warning" data-dismiss="modal">Change</button>
            </div>
        </div>
    </div>
</div>

<script>
    let number;

function getNumber(id)
{
    number = id;
}

function changeStatus()
{
    let name = "mem".concat(number);
    document.getElementById(name).style.display = "none";
    $.ajax({url: '/meme/del/waiting/'.concat(number)});
}

function deleteMem()
{
    let name = "mem".concat(number);
    document.getElementById(name).style.display = "none";
    $.ajax({url: '/meme/delete/'.concat(number)});
}

function like(meme_id)
{
    
    document.querySelector(".like".concat(meme_id)).disabled = true;
    document.querySelector(".notlike".concat(meme_id)).disabled = true;
        
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
    document.querySelector(".like".concat(meme_id)).disabled = true;
    document.querySelector(".notlike".concat(meme_id)).disabled = true;
    
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
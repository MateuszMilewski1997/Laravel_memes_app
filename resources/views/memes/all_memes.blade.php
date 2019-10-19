@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-9">
            @foreach ($memes as $meme)

            <div class="card w-100 mt-5" style="width: 18rem;">
                <div class="row">
                    <div class="col-5 ml-3" style="background: #888; color: white; margin-bottom: 15px; border-bottom-right-radius: 7px; padding-top: 5px;">
                        <h4>{{ $meme->title }}</h4>
                    </div>
                    <div class="col-5" style="padding-top: 5px;">
                            <h5> <i class="far fa-user"></i> : {{$meme->user->name}}</h5>
                    </div>
                </div>    
                <img src="{{ asset('storage/cover_images/'.$meme->photoPath) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    @if($meme->waiting_room == 1 && Auth::user()->role == "admin")
                    {{--<a href="/meme/del/waiting/{{$meme->id}}"><button class="btn btn-warning w-100">Change status</button></a>--}}
                    <button id="{{$meme->id}}" onclick="getNumber(this.id)" type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#exampleModalLong">Change status</button>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    {{--}li class="list-group-item">
                        <h3> <i class="far fa-clock"></i> : {{ $meme->created_at }}</h3>
                    </li>
                   --}}
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <h3> <i style="color:green;" class="far fa-thumbs-up"></i><span
                                        class="meme{{ $meme->id }}">{{ $meme->likes }}</span></h3>
                                @if(!isset($auth))
                                <button onclick="like(this.id)" id="{{ $meme->id }}" type="button"
                                    class="btn btn-outline-success w-100">Like</button>
                                @endif
                            </div>
                            <div class="col-6">
                                <h3> <i style="color:red;" class="far fa-thumbs-down"></i> <span
                                        class="dislike{{ $meme->id }}">{{ $meme->dislikes }}</span></h3>
                                @if(!isset($auth))
                                <button onclick="dislike(id)" id="{{ $meme->id }}" type="button"
                                    class="btn btn-outline-danger w-100">Dislike</button>
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
                    @endif
                </ul>
                <div class="card-body">
                    <a href="/meme/comments/{{ $meme->id }}"><button class="btn btn-lg btn-secondary w-100">Show
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
    </div>
    <div class="mt-5 d-flex justify-content-center">
            {{ $memes->links() }}
    </div>
</div>

  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Change status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <h2><i class="far fa-question-circle"></i></h2>
            <h3>Are you sure?</h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="changeStatus()" class="btn btn-success">Save changes</button>
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
    window.location.href = '/meme/del/waiting/'.concat(number);
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
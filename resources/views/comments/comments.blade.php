@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
   <div class="alert"></div>   
   <div class="row justify-content-center">
      <div class="col-sm-10 col-md-9">
         @foreach ($memes as $meme)
         <div class="card w-100 mt-5 comment">
            <div class="row">
               <div class="col-5 ml-3 commentTitle">
                  <h4>{{ $meme->title }}</h4>
               </div>
               <div class="col-5 commentUser">
                  <h5> <i class="far fa-user"></i> : {{$meme->user->name}}</h5>
               </div>
            </div>
            <img src="{{ asset('storage/cover_images/'.$meme->photoPath) }}" class="card-img-top" alt="...">
            <ul class="list-group list-group-flush">
               <li class="list-group-item">
                  <h4> <i class="far fa-clock"></i> : {{ $meme->created_at }}</h4>
               </li>
               <li class="list-group-item">
                  @if(Auth::check())                  
                     <div class="form-group">
                        <h5>Reminded <span id="chars">200</span> chars</h5>
                        <textarea onkeyup="handle(event)" name="content" id="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" minlength="10" maxlength="200" required></textarea>
                        <div class="commentError"></div>
                     <button onclick="sendComment()" data-username="{{ Auth::user()->name }}" data-id="{{ $meme->id }}" id="sendComment" class='btn btn-primary w-100 mt-4 mb-3'>Add comment</button>
                     </div>
                  @else
                  <h3>Login to write comment!</h3>
                  @endif
               </li>
               <li class="list-group-item">
                  <h2>Comments:</h2>
                  @if(isset($message))
                  <h3 class="mt-3">{{ $message }}</h3>
                  @endif
                  @foreach($comments as $comment)
                  <ul class="commentsList">
                     <li>
                        <div id="comment{{ $comment->id }}" class="w-100 mb-2 mt-3 commentList">
                           <h4><i class="far fa-user-circle"></i><span class="commentSpan"> {{$comment->user->name}}</span></h4>
                           <hr class="commentHr"/>
                           <h5 class="mt-3 comment{{$comment->id}}">{{$comment->content}}</h5>
                           <h5 class="mt-3"><i class="far fa-calendar-alt"></i> {{$comment->created_at}}</h5>
                           @if(Auth::check() && Auth::user()->role == "admin")
                           <button id="{{$comment->id}}" onclick="getNumber(this.id)" type="button" class="btn btn-sm btn-danger w-40" data-toggle="modal" data-target="#deleteComment">Delete comment</button>
                           @endif
                           @if(Auth::check() && Auth::user()->id == $comment->user->id)
                           <button id="{{$comment->id}}" onclick="getNumber(this.id)" type="button"  class="btn btn-sm btn-warning w-40" data-toggle="modal" data-target="#modalEditComment">Edit comment</button>
                           @endif
                        </div>
                     </li>
                  </ul>
                  @endforeach
                  <div class="mt-4">
                     {{ $comments->links() }}
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="mt-5 d-flex justify-content-center"></div>
</div>
<div class="modal fade" id="deleteComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <div class="modal-body commentModal">
            <h4><i class="fas fa-trash"></i></h4>
            <h3>Are you sure?</h3>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button onclick="delete_comment()" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalEditComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <textarea onkeyup="handle(event)" name="content" id="editComment" class="form-control" id="exampleFormControlTextarea1" rows="3" minlength="10" maxlength="200" required></textarea>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button onclick="updateComment()" type="button" data-dismiss="modal" class="btn btn-warning">Save changes</button>
         </div>
      </div>
   </div>
</div>
@endforeach
<script src="{{ asset('js/comments.js') }}"></script>
@endsection
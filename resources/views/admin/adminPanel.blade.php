@extends('layouts.app')
@section('content')

<div class="container">
  @if(isset($message))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <label class="sr-only mt-3" for="inlineFormInputGroupUsername">Username</label>
  <div class="input-group">
    <div class="input-group-prepend">
    </div>
    <input type="text" class="form-control mt-3" id="inlineFormInputGroupUsername" placeholder="Write email or name">
    <div class="input-group-text mt-3"><i class="fas fa-search"></i></div>
  </div>
  <table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Memes</th>
        <th scope="col">Comments</th>
        <th scope="col">Role</th>
        <th scope="col"></th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        @if(Auth::user()->id != $user->id)
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->memes->count() }}</td>
        <td>{{ $user->comments->count() }}</td>
        <td>{{ $user->role }}</td>
        <td><button id="{{$user->id}}" data-role="{{$user->role}}" onclick="getRole(this.id)" class="btn btn-warning"
            data-toggle="modal" data-target="#editRole">Edit role</button></td>
        <td><button id="{{$user->id}}" onclick="getNumber(this.id)" class="btn btn-danger" data-toggle="modal"
            data-target="#deleteUser">Delete</button></td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body align">
        <h3><i class="fas fa-trash"></i></h3>
        <h4>Are you sure</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="deleteUser()" type="button" class="btn btn-danger">Delete user</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body align">
        <h3 class="mb-4">Select role</h3>
        <select class="form-control mb-2" id="exampleFormControlSelect1">
          <option @if( $user->role == "user") selected @endif >user</option>
          <option @if( $user->role == "moderator") selected @endif >moderator</option>
          <option @if( $user->role == "admin") selected @endif >admin</option>
          <option @if( $user->role == "blocked") selected @endif >blocked</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="editRole()" class="btn btn-warning w-100">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-center">
  {{ $users->links() }}
</div>

<script src="{{ asset('js/adminPanel.js') }}"></script>

@endsection
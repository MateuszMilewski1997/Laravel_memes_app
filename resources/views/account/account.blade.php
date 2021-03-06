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
   @if($errors->any())
   <div class="alert alert-danger w-100" role="alert">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </div>
   @endif
   <div class="row mt-5">
      <div class="col-sm-12 col-md-6 mb-4">
         <form class="accountForm" method="post" action="/account/email" enctype="multipart/form-data">
            <div class="mb-4 accountFormHeader">
               <h3>Reset email</h3>
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Old email address</label>
               <input name="oldEmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Email address</label>
               <input name="newEmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-secondary mt-3 w-100">Submit</button>
         </form>
      </div>
      <div class="col-sm-12 col-md-6">
         <form class="formPassword" method="post" action="/account/password" enctype="multipart/form-data">
            <div class="mb-4 formPasswordHeader">
               <h3>Reset password</h3>
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Old password</label>
               <input name="oldPassword" type="password" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">New password</label>
               <input name="newPassword" type="password" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Repeat password</label>
               <input name="repeatPassword" type="password" class="form-control" id="exampleInputEmail1">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-secondary mt-3 w-100">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection
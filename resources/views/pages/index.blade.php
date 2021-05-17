@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-5 p-5 mt-5">
         <!-- Summary of App -->  
         <h1>Tweeblog</h1>
         <h4>A place to pour your thoughts.</h4> 
        </div>
        <div class="col-sm-7 rounded bg-light text-dark p-5 mt-5 mb-3">
          <!-- Join Section -->  
          <h1>Join Tweeblog Now!</h1>
          <hr>
          <h4 class="mb-3">Create account.</h4>
          <form>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputPassword1">
              </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Join :)</button>
          </form>
        </div>



</div>


@endsection
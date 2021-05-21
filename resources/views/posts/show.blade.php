@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-secondary mb-3">Back</a>
    <div class="card">
        <div class="card-body">
            <h1 class="mb-3">{{ $post->title }}</h1>
            @if(empty($user))
            <small>by Anon</small>
            @else
            <small>by {{ $user->name }}</small>
            @endif
            <p>{{ $post->body }}</p>
            <div class="d-flex justify-content-between">
                <small>Written on {{ $post->created_at }}</small>
                @if(!Auth::guest())
                    @if($post->user_id == Auth::user()->id )
                        <div class="d-flex">
                            <button type="button" class="btn btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#editpost-{{ $post->id }}"><i class="bx bx-pen bx-flashing-hover pe-2"></i>Edit</button>
                            <!--<a href="#" class="btn btn-outline-info me-2"><i class="bx bx-pen bx-flashing-hover pe-2"></i>Edit</a>-->
                            <button type="button" class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#deletepost-{{ $post->id }}"><i class="bx bx-error-circle bx-flashing-hover pe-2"></i>Danger</button>
                        </div>
                    @endif   
                @endif      
            </div>
        </div>
    </div>
          <!-- Modal Edit -->
      <div class="modal fade" id="editpost-{{ $post->id }}" tabindex="-1" aria-labelledby="editpost-{{ $post->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editpost-{{ $post->id }}Label">What are you thinking about?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/posts/{{$post->id}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <input type="text" name="title" class="form-control mb-2" value="{{ $post->title }}"/>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control" placeholder="Your message here">{{ $post->body }}</textarea> 
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit Post</button>
                </div>
            </form>
          </div>
        </div>
      </div> 
      
        <!-- Modal Delete-->
        <div class="modal fade" id="deletepost-{{ $post->id }}" tabindex="-1" aria-labelledby="#deletepost-{{ $post->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/posts/{{$post->id}}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="modal-body">
                        <h5>Are you sure want to delete this post?</h5>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete Post</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
@endsection
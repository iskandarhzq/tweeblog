@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->id != $user->id)
                        {{ $user->name }}
                    @else
                        {{ Auth::user()->name }}
                    @endif
                </div>
                <div class="card-body">
                    <!--<div class="text-center">
                            <img src="{{ asset('img/avatar.png') }}" alt="" class="rounded-circle border mx-auto d-block" style="height: 128px;">  
                    </div>-->
                    <form action="/profile/{{ Auth::user()->id }}/edit" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="image-upload d-flex justify-content-center flex-column">
                            <label for="file-input">
                                @if(!empty($user->image_file))
                                <img src="storage/image/{{$user->image_file}}" alt="" class="rounded-circle border mx-auto d-block" style="height: 128px;">
                                @else
                                <img src="{{ asset('img/avatar.png') }}" alt="" class="rounded-circle border mx-auto d-block" style="height: 128px;">
                                @endif
                            </label>
                            
                            @if (Auth::user()->id == $user->id)
                            <input id="file-input" type="file" name="image_file"/>
                            <div class="image-upload mt-2 d-flex justify-content-center">
                                <label for="file-input-2">
                                    <i class="btn btn-info bx bx-sm bx-cloud-upload text-white me-2"></i>
                                </label>
                                <input id="file-input-2" type="file" name="image_file"/>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            @endif
                        </div>

                    </form>
                    <hr class="mt-3">
                    <div id="selector" class="nav-menu navbar ps-3">
                        <ul>
                            <li>
                                <button type="button" class="btn btn-md btn-dark px-3 py-2" data-bs-toggle="modal" data-bs-target="#quickpost">
                                    <i class="bx bx-plus bx-tada-hover bx-xs text-light pe-2"></i>Quick Post
                                    </button>
                            </li>
                          <li><a href="{{ url('/') }}" class="nav-link"><i class="bx bx-home"></i><span class="text-dark">All Post</span></a></li>
                          <li><a href="{{ url('/about') }}" class="nav-link"><i class="bx bx-user"></i> <span class="text-dark">Liked Post</span></a></li>
                          <li><a href="{{ url('/artwork') }}" class="nav-link"><i class="bx bx-book-content"></i> <span class="text-dark">Direct Message</span></a></li>
                          @if (Auth::user()->id == $user->id)
                          <li><a href="{{ url('/projects') }}" class="nav-link"><i class="bx bx-file-blank"></i> <span class="text-dark">Notifications</span></a></li>
                          <li><a href="{{ url('/resume') }}" class="nav-link"><i class="bx bx-server"></i> <span class="text-dark">Bookmark</span></a></li>
                          <li><a href="{{ url('/contact') }}" class="nav-link"><i class="bx bx-envelope"></i> <span class="text-dark">More</span></a></li>
                          @endif
                        </ul>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            @if(!empty($posts))
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        {{ $post->body }}
                        <hr>
                            <div class="d-flex justify-content-between">
                                <small>Written on {{ $post->created_at }}</small>
                                @if(!Auth::guest())
                                    @if($post->user_id == Auth::user()->id )
                                        @if (Auth::user()->id == $user->id)
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#editpost-{{ $post->id }}"><i class="bx bx-pen bx-flashing-hover pe-2"></i>Edit</button>
                                            <!--<a href="#" class="btn btn-outline-info me-2"><i class="bx bx-pen bx-flashing-hover pe-2"></i>Edit</a>-->
                                            <button type="button" class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#deletepost-{{ $post->id }}"><i class="bx bx-error-circle bx-flashing-hover pe-2"></i>Danger</button>
                                        </div>
                                        @endif
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
                @endforeach    
            @endif
        </div>
    </div>
</div>
@endsection

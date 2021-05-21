@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-3">
                    <div class="card" style="position:fixed;">
                        <div class="card-body">
                            <h5 style="padding-right:12rem;">Trending</h5>
                            <hr>
                            <p>#1 Haziq Macho</p>
                        </div>
                    </div>
            </div>
            <div class="col-7">
                @if(count($posts) > 0) 
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    @if($post->user_id == $user['id'])
                                        <div class="d-flex align-items-center mb-3">
                                            @if(!empty($user['image_file']))
                                                <img src="storage/image/{{ $user['image_file'] }}" alt="" class="rounded-circle border d-block me-2" style="height: 50px;">
                                            @else
                                                <img src="{{ asset('img/avatar.png') }}" alt="" class="rounded-circle border d-block me-2" style="height: 50px;">
                                            @endif
                                            <h5><a href="profile/{{ $user['id'] }}">{{ $user['name'] }}</a></h5>
                                        </div>
                                        @break  
                                    @endif    
                                @endforeach
                            @else
                                <small>by Anon</small>
                            @endif
                            <a href="/posts/{{ $post->id }}"><h5>{{ $post->title }}</h5></a>
                            <h5>{{ $post->body }}</h5>
                            <hr>
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
                @endforeach    
            @else
                <div class="card">
                    <div class="card-body">
                        <h3>Oops! No posts found.</h3>  
                    </div>
                </div>     
            @endif
            </div>
            <div class="col-2">
                <nav id="selector" class="nav-menu navbar position-fixed ps-3">
                    <ul>
                        <li>
                            <button type="button" class="btn btn-md btn-dark px-2 py-2" data-bs-toggle="modal" data-bs-target="#quickpost">
                                <i class="bx bx-plus bx-tada-hover bx-xs text-light pe-2"></i>Quick Post
                                </button>
                        </li>
                      <li><a href="{{ url('/') }}" class="nav-link"><i class="bx bx-home"></i><span class="text-dark">Home</span></a></li>
                      <li><a href="{{ url('/about') }}" class="nav-link"><i class="bx bx-user"></i> <span class="text-dark">Explore</span></a></li>
                      <li><a href="{{ url('/projects') }}" class="nav-link"><i class="bx bx-file-blank"></i> <span class="text-dark">Notifications</span></a></li>
                      <li><a href="{{ url('/artwork') }}" class="nav-link"><i class="bx bx-book-content"></i> <span class="text-dark">Messages</span></a></li>
                      <li><a href="{{ url('/resume') }}" class="nav-link"><i class="bx bx-server"></i> <span class="text-dark">Bookmare</span></a></li>
                      <li><a href="{{ url('/contact') }}" class="nav-link"><i class="bx bx-envelope"></i> <span class="text-dark">More</span></a></li>
                    </ul>
                  </nav>
            </div>
        </div>
        
    <!-- Modal -->
<div class="modal fade" id="quickpost" tabindex="-1" aria-labelledby="quickpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="quickpostLabel">What are you thinking about?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('/posts') }}" method="post">
            @csrf
            <div class="modal-body">
                <input type="text" name="title" class="form-control mb-2" placeholder="Your title here"/>
                <textarea name="body" id="article-ckeditor" cols="30" rows="10" class="form-control" placeholder="Your message here"></textarea>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Post</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
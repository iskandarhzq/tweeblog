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
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-info me-2">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app')

@section('body')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">uplink</h1>
    <a href="{{route('post.create')}}" class="btn btn-primary">Add Post</a>
</div>
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
<div style="display: flex;justify-content: center;">
    <div class="card m-3" style="width: 40rem;">
        <img src="https://via.placeholder.com/200" class="card-img-top" alt="Card Image">
        <div class="card-body">
            <h5 class="card-title">{{ $selected_post->Title }}</h5>
            <p class="card-text">{{ $selected_post->Description }}</p>
        </div>
        <div class="card-footer">
            <!-- Like Button with Bootstrap Icon -->
            @if($selected_post->isLiked)

            <button class="btn btn-primary" disabled>
                <i class="bi bi-hand-thumbs-up"></i> Liked {{ $selected_post->likes_count }}
            </button>
            <form class="btn"  action="{{ route('remove.like', ['post_id' => $selected_post->Post_Id]) }}" method="post">
                @csrf
                <button class="btn btn-danger"  type="submit">Unlike </button>
            </form>
            <!-- <a href="" type="button" class="btn btn-danger ">Unlike</a> -->
            @else

            <form class="btn"  action="{{ route('add.like', ['post_id' => $selected_post->Post_Id]) }}" method="post">
                @csrf
                <button class="btn btn-light" style="border-color: black;" type="submit">Add Like {{ $selected_post->likes_count }} </button>
            </form>
            @endif
            <!-- Share Button with Bootstrap Icon -->
            <button class="btn btn-info">
                <i class="bi bi-share"></i> Share
            </button>

            <!-- Download Button with Bootstrap Icon -->
            <a href="#" class="btn btn-success">
                <i class="bi bi-cloud-download"></i> Download
            </a>

        
        </div>
    </div>
</div>
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
@if($posts->count() > 0)
@foreach($posts as $post)

<div style="display: flex;justify-content: center;">
    <div class="card m-3" style="width: 25rem;">
        <img src="https://via.placeholder.com/200" class="card-img-top" alt="Card Image">
        <div class="card-body">
            <h5 class="card-title">{{ $post->Title }}</h5>
            <p class="card-text">{{ $post->Description }}</p>
        </div>
        <div class="card-footer">
            <!-- Like Button with Bootstrap Icon -->
            @if($post->isLiked)

            <button class="btn btn-primary" disabled>
                <i class="bi bi-hand-thumbs-up"></i> Liked {{ $post->likes_count }}
            </button>
            <a href="" type="button" class="btn btn-danger ">Unlike</a>
            @else
<!--             
            <form action="{{ route('add.like') }}" method="post">
                @csrf
                <button type="submit">Add Like</button>
            </form> -->

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


@endforeach
@else
<tr>
    <td class="text-center" colspan="5">Posts not found</td>
</tr>
@endif
@endsection
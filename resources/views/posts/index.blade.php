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
    <div class="card m-3" style="width: 40rem;">
        <img src="https://via.placeholder.com/200" class="card-img-top" alt="Card Image">
        <div class="card-body">
            <h5 class="card-title">{{ $post->Title }}</h5>
            <p class="card-text">{{ $post->Description }}</p>
        </div>
        <div class="card-footer">
            <!-- Like Button with Bootstrap Icon -->
            @if($post->isLiked)

            <button class="btn btn-primary" disabled>
                <i class="fa fa-thumbs-up"></i> Liked {{ $post->likes_count }}
            </button>
            <form class="btn"  action="{{ route('remove.like', ['post_id' => $post->Post_Id]) }}" method="post">
                @csrf
                <button class="btn btn-danger"  type="submit"><i class="fa fa-thumbs-down" ></i> Unlike </button>
            </form>
            <!-- <a href="" type="button" class="btn btn-danger ">Unlike</a> -->
            @else

            <form class="btn"  action="{{ route('add.like', ['post_id' => $post->Post_Id]) }}" method="post">
                @csrf
                <button class="btn" style="border-color: black;" type="submit"><i class="fa fa-thumbs-up"></i> Add Like {{ $post->likes_count }} </button>
            </form>
            @endif
            <!-- Share Button with Bootstrap Icon -->

            <form class="btn"  action="{{ route('post.share', ['post_id' => $post->Post_Id]) }}" method="post">
                @csrf
                <button class="btn btn-info" type="submit"> <i class="fa fa-share"></i> Share </button>
            </form>

            <!-- Download Button with Bootstrap Icon -->
            <a href="#" class="btn btn-success">
                <i class="bi bi-cloud-download"></i> Download
            </a>

            <a href="{{ route('post.show',  $post->Post_Id) }}" type="button" class="btn btn-secondary">Detail</a>
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
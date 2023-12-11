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
    <div>{{ $post->Title }}</div>
    @endforeach
    @else
        <tr>
            <td class="text-center" colspan="5">Posts not found</td>
        </tr>
    @endif
@endsection
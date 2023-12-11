@extends('layouts.app')

@section('body')
<h1 class="mb-0">Add Post</h1>
<hr />
<form action="{{ route('post.store') }}" method="POST">
    @csrf
        <div class="col mb-2">
            <input type="text" name="Title" class="form-control" placeholder="Title">
        </div>
        <div class="col mb-2">
            <input type="number" name="Editor_Id" class="form-control" placeholder="Editor Id">
        </div>
        <div class="col mb-2">
            <textarea class="form-control" name="Description" placeholder="Descriptoin"></textarea>
        </div>
        <div class="col mb-2">
            <input type="date" name="Expire_Date" class="form-control" placeholder="Expire Date">
        </div>
   
        <div class="col mb-2">
            <input type="number" name="likes_count" class="form-control" placeholder="Like Count">
        </div>
        <div class="col mb-2">
            <input type="text" name="media_path" class="form-control" placeholder="Media Path">
        </div>
        <div class="col mb-2">
            <input type="text" name="Approval_Letter" class="form-control" placeholder="Approval Letter" >
        </div>
        <div class="col mb-2">
            <input type="number" name="Society_Id" class="form-control" placeholder="Society Id" >
        </div>
        <div class="col mb-2">
            <input type="number" name="Dep_Id" class="form-control" placeholder="Department Id" >
        </div>
        <div class="col mb-2">
            <input type="number" name="Faculty_Id" class="form-control" placeholder="Faculty Id" >
        </div>
       

        <div class="d-grid">
            <button class="btn btn-primary">Submit</button>
        </div>
  
</form>
@endsection
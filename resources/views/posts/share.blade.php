@extends('layouts.app')

@section('body')
<style>
    .share-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .share-link {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    .copy-button {
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
    }
</style>

<div class="card text-center" style="width: 30rem;margin-left: 47rem; margin-top: 12rem; ">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body" >
        <h5 class="card-title">Share Post</h5>
        <div class="share-link" id="post-link">http://127.0.0.1:8000/post/{{$id}}</div>
        <div class="btn-group">
            <!-- WhatsApp share -->
            <a href="whatsapp://send?text=Check out this post: {{ url()->current() }}" class="btn btn-whatsapp" target="_blank">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>

            <!-- Facebook share -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="btn btn-facebook" target="_blank">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>

            <!-- Twitter share -->
            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Check out this post: Title of the Post" class="btn btn-twitter" target="_blank">
                <i class="fab fa-twitter"></i> Twitter
            </a>
            <button class="btn btn-copy" onclick="copyLink()">
                <i class="fas fa-copy"></i> Copy Post Link
            </button>
        </div>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>






<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-+Z5FN2KAlN1D3zF2Q62B5eYIvBl3fD2Nf5z+J8VVg55bfaTOr8VoRC9cVQTsHL3QF8d3tFH82KQdu2UcHh5GCA==" crossorigin="anonymous"></script>
<script>
    function copyLink() {
        var copyText = document.getElementById("post-link");
        var input = document.createElement("input");
        input.value = copyText.textContent;
        document.body.appendChild(input);
        input.select();
        document.execCommand("copy");
        document.body.removeChild(input);
        alert("Link copied to clipboard!");
    }
</script>
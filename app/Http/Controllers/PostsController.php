<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
     
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $likes = Like::orderBy('created_at', 'DESC')->get();
        $currentUserID = config('app.user_Id');
        
        $posts = Posts::orderBy('created_at', 'DESC')->get();
        $userID = $currentUserID;

        $likedPostIds = Like::where('user_id_FrKey', $userID)->pluck('Post_id_FrKey')->toArray();



        foreach ($posts as $post) {
            $post->isLiked = false;
            foreach ($likedPostIds as $likedPostId) {
                if ($post->Post_Id === $likedPostId) {
                    $post->isLiked = true;
                    break;
                }
            }
        }


        return view('posts.index', compact('posts'));
    }

    public function addLike($post_id)
    {
        $currentUserID = config('app.user_Id');

        $like = new Like();
         
        $existingLike = Like::where('post_id_FrKey', $post_id)
                            ->where('user_id_FrKey', 1) 
                            ->first();

        if ($existingLike) {
            return "Like already exists!";
        }

        $like->user_id_FrKey = $currentUserID;
        $like->post_id_FrKey = $post_id;

        $like->save();
        Posts::where('Post_Id', $post_id)->increment('likes_count');
        return redirect()->route('post.index');
    }

    public function unlike($post_id)
    {
        $currentUserID = config('app.user_Id');
    

        // Find and delete the like record based on the hardcoded values
        Like::where('user_id_FrKey', $currentUserID)
            ->where('post_id_FrKey', $post_id)
            ->delete();
        Posts::where('Post_Id', $post_id)->decrement('likes_count');
        return redirect()->route('post.index');

    }



    public function showAddLikeForm()
    {
        return view('add-like');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Posts::create($request->all());
        return redirect()->route('post.index')->with('success', 'post added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $likes = Like::orderBy('created_at', 'DESC')->get();
        $currentUserID = config('app.user_Id');
        
        $posts = Posts::orderBy('created_at', 'DESC')->get();
        $userID = $currentUserID;

        $likedPostIds = Like::where('user_id_FrKey', $userID)->pluck('Post_id_FrKey')->toArray();



        foreach ($posts as $post) {
            $post->isLiked = false;
            foreach ($likedPostIds as $likedPostId) {
                if ($post->Post_Id === $likedPostId) {
                    $post->isLiked = true;
                    break;
                }
            }
        }

        foreach ($posts as $post) {
            if($post->Post_Id == $id){
                $selected_post  = $post;
            }
        }

        

        return view('posts.show', compact('selected_post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $postId)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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

        // Create a new Like instance
        

        // Set the user_id_FrKey and post_id_FrKey values
        $like->user_id_FrKey = $currentUserID;
        $like->post_id_FrKey = $post_id;

        // Save the like to the database
        $like->save();

        return "Like added successfully!";
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


    // public function like($postId)
    // {
    //      $userId = 1;
    //     Like::updateOrCreate(
    //         ['Post_id_FrKey' => $postId, 'user_id_FrKey' => $userId],
    //     );
    // }

    public function like(Request $request, $postId)
    {
        // Assume that you have authenticated users, and you can get the user ID like this
        $currentUserID = config('app.user_Id');

        // Check if the user has already liked the post
        $existingLike = Like::where('user_id_FrKey', $currentUserID)->where('Post_id_FrKey', $postId)->first();

        if (!$existingLike) {
            // If the user hasn't liked the post, create a new like
            Like::create([
                'user_id_FrKey' => $currentUserID,
                'Post_id_FrKey' => $postId,
            ]);

            return redirect()->back()->with('success', 'Post liked successfully!');
        } else {
            // If the user has already liked the post, you may want to handle this case
            // For example, you can redirect back with a message or perform some other action.
            return redirect()->back()->with('error', 'You have already liked this post!');
        }
    }
}

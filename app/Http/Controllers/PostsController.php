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
        $posts = Posts::orderBy('created_at', 'DESC')->get();

        $userID = 1;
        
        $likedPostIds = Like::where('user_id_FrKey', $userID)->pluck('Post_id_FrKey')->toArray();
    
      

        foreach ($posts as $post) {
            $post->isLiked = false;
            foreach ($likedPostIds as $likedPostId) {
                if ($post->Post_Id === $likedPostId) { // Assuming your primary key column is named 'id'
                    $post->isLiked = true;
                    break; // Exit the loop once a match is found
                }
            }
        }

        dump($posts);
        return view('posts.index', compact('posts'));
       
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
        $post = Posts::find($id);
        var_dump($post->users);
        return  view('posts.show')->with('users',$post);
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
        $userId = 1;
        Like::updateOrCreate(
            ['Post_id_FrKey' => $postId, 'user_id_FrKey' => $userId],
        );
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
        $userId = 1;

        // Check if the user has already liked the post
        $existingLike = Like::where('user_id_FrKey', $userId)->where('Post_id_FrKey', $postId)->first();

        if (!$existingLike) {
            // If the user hasn't liked the post, create a new like
            Like::create([
                'user_id_FrKey' => $userId,
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

<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
// use App\Http\Requests\StorePostsRequest;
// use App\Http\Requests\UpdatePostsRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Posts::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
       
        
        $post = Posts::create($fields);
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $post)
    {
        $fields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
       
        
        $post -> update($fields);
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
       $posts->delete();
       return [
        'message' => 'Post deleted'
       ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;

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
    public function store(StorePostsRequest $request)
    {
        $fields = $request->validated();
        $post = $request->user()->posts()->create($fields);
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        $post = Posts::findOrFail($id);
        Gate::authorize('modify', $posts);
        $fields = $request->validated();
       
        $post -> update($fields);
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $posts = Posts::findOrFail($id);
       Gate::authorize('modify', $posts);
       $posts->delete();
       return [
        'message' => 'Post deleted'
       ];
    }
}

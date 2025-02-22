<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Mail\PostPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
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

        Mail::to(Auth::user())->send(new PostPublished(Auth::user(), $post)); 
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
        Gate::authorize('modify', $post);
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

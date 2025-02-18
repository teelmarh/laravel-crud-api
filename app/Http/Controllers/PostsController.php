<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
// use App\Http\Requests\StorePostsRequest;
// use App\Http\Requests\UpdatePostsRequest;

class PostsController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return[
            new Middleware('auth:sanctum', except: ['index', 'show'] )
        ];
    }

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
       
        
        $post = $request->user()->posts()->create($fields);
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
    public function update(Request $request, Posts $posts)
    {
        Gate::authorize('modify', $posts);
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
       Gate::authorize('modify', $posts);
       $posts->delete();
       return [
        'message' => 'Post deleted'
       ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index () {
        $posts = Post::paginate(5);
        

        foreach($posts as $post) {
            if(str_contains($post->cover, 'http')) {
                $post->cover = url($post->cover);
                } else {
                $post->cover = url('storage/'.$post->cover);
                }
        }

        return response()->json($posts);
    }

    public function show ($slug) {
        $posts = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        return response()->json($posts);
    }

    
}

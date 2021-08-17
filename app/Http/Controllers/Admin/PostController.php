<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::all();
         return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view ('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();  //data
        // dd($post);
        $request->validate(
            [
                'title' => 'required|max:255',
                'body' => 'required',
                'cover' => 'mimes:jpg,bmp,png|nullable|max:2048'
            ],
            [
                'title.required' => 'Inserire un titolo',
                'body.required' => 'Inserire corpo articolo',
                'cover.required' => 'Controlla estensione e grandezza immagine'
            ]
        );
        $posts = new Post(); //newPost
        $slug = Str::slug($post['title'], "-");

        $slugEsistente = Post::where('slug', $slug)->first(); //esiste o no //esiste mi ritorno il post altrimenti null
        $count = 1;
        $slug_base = $slug;
        while($slugEsistente){
            $slug = $slug_base . '-' . $count;
            $slugEsistente = Post::where('slug', $slug)->first();
            $count++;
        };
        $post['slug'] = $slug;
        //valorizzare i singoli campi

        if(ARRAY_KEY_EXISTS('cover', $post)) {
            $imgPath = Storage::put('images', $post['cover']);
            $post['cover'] = $imgPath;
        }

         
        $posts->fill($post); //ci serve nel modello Post il protected $fillable = ['title', 'slug', 'content', 'category_id']
        $posts->save();

        if(array_key_exists('tags', $post)) {
            // $newPost->tags()->sync($data["tags"]);
            $posts->tags()->attach($post["tags"]);
        }


        return redirect()->route('admin.posts.show', $posts->id);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view ('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view ('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        
        $request->validate(
            [
                'title' => 'required|max:255',
                'body' => 'required',
                'cover' => 'mimes:jpg,bmp,png|nullable|max:2048'
            ],
            [
                'title.required' => 'Inserire un titolo',
                'body.required' => 'Inserire corpo articolo',
                'cover.required' => 'Controlla estensione e grandezza immagine'
            ]
        );

        if($post->title != $data["title"]) {
            $slug = Str::slug($data['title'], "-");

            $slugEsistente = Post::where('slug', $slug)->first(); //esiste o no //esiste mi ritorno il post altrimenti null
            $count = 1;
            $slug_base = $slug;
            while($slugEsistente){
                $slug = $slug_base . '-' . $count;
                $slugEsistente = Post::where('slug', $slug)->first();
                $count++;
            };
            $data['slug'] = $slug;
        }

        if(array_key_exists('cover', $data)) {
            if($post->cover) {
                Storage::delete($post->cover);
            }

            $data["cover"] = Storage::put('post_covers', $data["cover"]);
        }

        $post -> update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data["tags"]);
        } else {
            // $post->tags->sync([]);
            $post->tags()->detach();
        }


        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        if($post->cover) {
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

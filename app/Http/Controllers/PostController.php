<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PostController  extends Controller
{
    public function index() {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }
    public function show(Post $post) {
        
        $post = Post::find($post->id);
        /* TODO: Falta la Validacion de si los datos no existen */

        return view('posts.show', compact('post'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* TODO: Falta la Validacion de los datos */
        $data = request()->validate([
            'title' => "required",
            'content'=>'required'
        ]);
        $post=Post::create($data);
        return redirect('/posts/' . $post->id);

    }
    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => "required",
            'content'=>'required'
        ]);
        $post->update($data);
        return redirect('/posts/'. $post->id);

    }
    public function destroy(Post $post)
    {
      
        $post->delete();
        return redirect('/posts');

    }

   
}

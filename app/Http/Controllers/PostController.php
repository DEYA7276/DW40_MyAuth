<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts/index', [
            'posts' => Post::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $message = request('message');
       //validations
      $dataValidates = $request->validate([
        'message' => ['required', 'min:8'],
       ]);
       
        // Post::create([
        //   // 'message' => $message,
        //   'message' => $request->get('message'),
        //     'user_id' => auth()->id(),// Aquí se asocia el post a el usuario logueado
        // ]);

        //Generar un registro a traves de una relacion hasmany
        // primero accediento al user desde el request, luego a post desde user
       // @dump($dataValidates);
        // $request->user()->posts()->create([
        //     'message' => $request->get('message'),
        // ]);
        $request->user()->posts()->create($dataValidates);
        // Post::create([
        //     // 'message' => $message,
        //     'message' => $request->get('message'),
        //   ]);
        return to_route('posts.index')->with('status', _('Post created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        // if(auth()->user()->id == $post->user_id){
        //     abort(403);
        // }

        $this->authorize('update', $post);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $dataValidates = $request->validate([
            'message' => ['required','min:8', 'max:255'],
        ]);

        $post->update($dataValidates);

        return to_route('posts.index', $post)->with('status', __('Post updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return to_route('posts.index')->with('status', __('Post deleted successfully'));
    }
}

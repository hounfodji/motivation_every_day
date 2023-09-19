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
        $posts = Post::all();
        //dd($posts);
        return view('dashboard', compact('posts'));
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
        $data = $request->validate([
            'title' => 'required|max:100',
            'detail' => 'required|max:500',
        ]);
        // Assume that you have the currently authenticated user.
        $user = auth()->user(); // This assumes you have user authentication set up.
        //dd(auth()->id);
        $post = new Post([
            'title' => $request->title,
            'detail' => $request->detail,
            // 'state' => false, // or true depending on the desired state
            'user_id' => $user->id // Associez le post à l'utilisateur actuellement authentifié
        ]);
        //dd($user);
        //dd($post);
        $post->save();
        return back()->with('message', "Le post a bien été créé !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:100',
            'detail' => 'required|max:500',
        ]);
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->state = $request->has('state');
        $post->save();
        return back()->with('message', "Le post a bien été modifié!! !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // Flash a success message to the session
        session()->flash('success', 'Le post a été supprimé avec succès.');

        // Redirect the user to the dashboard
        return redirect('/dashboard');
    }
}

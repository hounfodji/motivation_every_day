<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'author' => 'required|max:100',
            'detail' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Vérification de l'image
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('post_images', 'public');
        } else {
            $imagePath = null;
        }

        $user = Auth::user(); // Utilisateur actuellement authentifié
        $post = new Post([
            'title' => $request->title,
            'detail' => $request->detail,
            'author' => $request->author,
            // 'state' => false, // Vous pouvez définir l'état par défaut ici
            'user_id' => $user->id,
            'image' => $imagePath, // Enregistrez le chemin de l'image
            'username' => $user->name, // Remplacez 'author' par le nom de l'auteur approprié
        ]);

        $post->save();
        // dd($post);
        return redirect('/dashboard');
        // return back()->with('message', "Le post a bien été créé !");
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
            'author' => 'required|max:100',
            'detail' => 'required|max:500',
        ]);

        // Gestion de l'image (mise à jour)
        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si elle existe
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('post_images', 'public');
        } else {
            $imagePath = $post->image; // Conservez l'ancien chemin de l'image
        }

        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->author = $request->author;
        // $post->state = $request->has('state');
        $post->image = $imagePath; // Mettez à jour le chemin de l'image
        $post->save();
        return redirect('/dashboard');
        //return back()->with('message', "Le post a bien été modifié !!");
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

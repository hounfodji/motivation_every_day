<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Sélectionner les posts de l'utilisateur connecté
        $posts = Post::where('user_id', $user->id)->paginate(5); // 5 éléments par page

        // Sélectionner les histoires de l'utilisateur connecté
        $histories = History::where('user_id', $user->id)->paginate(5); // 5 éléments par page

        return view('dashboard', compact('posts', 'histories'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024', // Vérification de l'image
        ]);
        

        // Obtenez le fichier téléchargé
        $uploadedFile = $request->file('image');

        // Générez un nom de fichier unique en utilisant le nom d'origine 
        $fileName = $uploadedFile->getClientOriginalName();

        // Chemin pour stocker l'image réelle avec le nom généré
        $realImagePath = $uploadedFile->storeAs('post_images/real', $fileName, 'public');

        // Chemin complet de l'image réelle téléchargée
        $realImageFullPath = storage_path('app/public/' . $realImagePath);

        // Chemin pour stocker l'image compressée et redimensionnée
        $compressedImagePath = 'post_images/compressed/' . $request->file('image')->getClientOriginalName();

        // Redimensionnez et compressez l'image
        Image::make($realImageFullPath)
            ->fit(442, 249, function ($constraint) {
                $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 442x249
            })
            ->save(storage_path('app/public/' . $compressedImagePath));

        $user = Auth::user(); // Utilisateur actuellement authentifié
        $post = new Post([
            'title' => $request->title,
            'detail' => $request->detail,
            'author' => $request->author,
            'user_id' => $user->id,
            'image_real' => $realImagePath, // Enregistrez le chemin de l'image réelle 
            'image_compressed' => $compressedImagePath, // Enregistrez le chemin de l'image compressée et redimensionnée
            'username' => $user->name,
        ]);

        $post->save();

        return redirect('/dashboard');
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

    if ($request->hasFile('image_real')) {
        // Supprimez l'ancienne image réelle et son image compressée associée s'ils existent
        if ($post->image_real) {
            Storage::disk('public')->delete($post->image_real);
        }

        if ($post->image_compressed) {
            Storage::disk('public')->delete($post->image_compressed);
        }

        // Obtenez le fichier téléchargé
        $uploadedFile = $request->file('image_real');

        // Générez un nom de fichier unique en utilisant le nom d'origine 
        $fileName = $uploadedFile->getClientOriginalName();

        // Chemin pour stocker l'image réelle avec le nom généré
        $realImagePath = $uploadedFile->storeAs('post_images/real', $fileName, 'public');

        // Chemin complet de l'image réelle téléchargée
        $realImageFullPath = storage_path('app/public/' . $realImagePath);

        // Compresser l'image réelle
        $compressedImagePath = 'post_images/compressed/' . $fileName;
        Image::make($realImageFullPath)
            ->fit(442, 249, function ($constraint) {
                $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 442x249
            })
            ->save(storage_path('app/public/' . $compressedImagePath));

        // Mettez à jour les chemins des images dans la base de données
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->author = $request->author;
        $post->image_real = $realImagePath;
        $post->image_compressed = $compressedImagePath;
        $post->save();
    } else {
        // Si aucune nouvelle image réelle n'a été fournie, mettez à jour les autres données du post
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->author = $request->author;
        $post->save();
    }

    return redirect('/dashboard');
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

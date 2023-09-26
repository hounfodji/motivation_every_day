<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::all();
        // dd($histories);
        return view('histories.all_histories', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('histories.create');
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
        $realImagePath = $uploadedFile->storeAs('history_images/real', $fileName, 'public');

        // Chemin complet de l'image réelle téléchargée
        $realImageFullPath = storage_path('app/public/' . $realImagePath);

        // Chemin pour stocker l'image compressée et redimensionnée
        $compressedImagePath = 'history_images/compressed/' . $request->file('image')->getClientOriginalName();

        // Redimensionnez et compressez l'image
        Image::make($realImageFullPath)
            ->fit(442, 249, function ($constraint) {
                $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 442x249
            })
            ->save(storage_path('app/public/' . $compressedImagePath));

        $user = Auth::user(); // Utilisateur actuellement authentifié
        $history = new History([
            'title' => $request->title,
            'detail' => $request->detail,
            'author' => $request->author,
            'user_id' => $user->id,
            'image_real' => $realImagePath, // Enregistrez le chemin de l'image réelle 
            'image_compressed' => $compressedImagePath, // Enregistrez le chemin de l'image compressée et redimensionnée
            'username' => $user->name,
        ]);

        $history->save();

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        return view('histories.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        return view('histories.edit', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
{
    $data = $request->validate([
        'title' => 'required|max:100',
        'author' => 'required|max:100',
        'detail' => 'required|max:500',
    ]);

    if ($request->hasFile('image_real')) {
        // Supprimez l'ancienne image réelle et son image compressée associée s'ils existent
        if ($history->image_real) {
            Storage::disk('public')->delete($history->image_real);
        }

        if ($history->image_compressed) {
            Storage::disk('public')->delete($history->image_compressed);
        }

        // Obtenez le fichier téléchargé
        $uploadedFile = $request->file('image_real');

        // Générez un nom de fichier unique en utilisant le nom d'origine 
        $fileName = $uploadedFile->getClientOriginalName();

        // Chemin pour stocker l'image réelle avec le nom généré
        $realImagePath = $uploadedFile->storeAs('history_images/real', $fileName, 'public');

        // Chemin complet de l'image réelle téléchargée
        $realImageFullPath = storage_path('app/public/' . $realImagePath);

        // Compresser l'image réelle
        $compressedImagePath = 'history_images/compressed/' . $fileName;
        Image::make($realImageFullPath)
            ->fit(442, 249, function ($constraint) {
                $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 442x249
            })
            ->save(storage_path('app/public/' . $compressedImagePath));

        // Mettez à jour les chemins des images dans la base de données
        $history->title = $request->title;
        $history->detail = $request->detail;
        $history->author = $request->author;
        $history->image_real = $realImagePath;
        $history->image_compressed = $compressedImagePath;
        $history->save();
    } else {
        // Si aucune nouvelle image réelle n'a été fournie, mettez à jour les autres données du history
        $history->title = $request->title;
        $history->detail = $request->detail;
        $history->author = $request->author;
        $history->save();
    }

    return redirect('/dashboard');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        $history->delete();

        // Flash a success message to the session
        session()->flash('success', 'Le post a été supprimé avec succès.');

        // Redirect the user to the dashboard
        return redirect('/dashboard');
    }
}

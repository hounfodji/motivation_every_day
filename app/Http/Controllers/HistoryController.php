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
        // $histories = History::all();
        // // dd($histories);
        // return view('dashboard', compact('histories'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Vérification de l'image
        ]);

         // Gestion de l'image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('history_images', 'public');

        // Chemin complet de l'image téléchargée
        $imageFullPath = storage_path('app/public/' . $imagePath);

        // Redimensionnez et compressez l'image à une taille maximale de 800x800 pixels
        $image = Image::make($imageFullPath)->fit(1110, 500, function ($constraint) {
            $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 800x800
        });

        // Sauvegardez l'image redimensionnée et compressée
        $image->save($imageFullPath);
    } else {
        $imagePath = null;
    }



        $user = Auth::user(); // Utilisateur actuellement authentifié
        $history = new History([
            'title' => $request->title,
            'detail' => $request->detail,
            'author' => $request->author,
            // 'state' => false, // Vous pouvez définir l'état par défaut ici
            'user_id' => $user->id,
            'image' => $imagePath, // Enregistrez le chemin de l'image
            'username' => $user->name, // Remplacez 'author' par le nom de l'auteur approprié
        ]);

        $history->save();
        //  dd($history);
        return redirect('/dashboard');
        // return back()->with('message', "Le post a bien été créé !");
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

        // Gestion de l'image (mise à jour)
        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si elle existe
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }

            $imagePath = $request->file('image')->store('history_images', 'public');
    
            // Chemin complet de l'image téléchargée
            $imageFullPath = storage_path('app/public/' . $imagePath);
    
            // Redimensionnez et compressez l'image à une taille maximale de 800x800 pixels
            $image = Image::make($imageFullPath)->fit(442, 249, function ($constraint) {
                $constraint->upsize(); // Redimensionnez uniquement si l'image est plus grande que 800x800
            });
    
            // Sauvegardez l'image redimensionnée et compressée
            $image->save($imageFullPath);
        } 
        else {
            $imagePath = $history->image; // Conservez l'ancien chemin de l'image
        }

        $history->title = $request->title;
        $history->detail = $request->detail;
        $history->author = $request->author;
        // $history->state = $request->has('state');
        $history->image = $imagePath; // Mettez à jour le chemin de l'image
        $history->save();
        return redirect('/dashboard');
        //return back()->with('message', "Le post a bien été modifié !!");
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

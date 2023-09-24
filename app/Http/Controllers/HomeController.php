<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $posts = Post::all();
        $history = History::latest()->first(); // Récupérer la dernière histoire créée
        return view('home', compact("posts", "history"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $posts = Post::all();
        $history = History::inRandomOrder()->first(); //Prendre un post de manière aléatoire
        // dd($history);
        return view('home', compact("posts", "history"));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title', // Ajoutez 'title' ici pour permettre l'attribution de masse
        'detail',
        //'state',
        'user_id',
        'image', // Ajout du champ image
        'author', // Ajout du champ author
        // Autres colonnes si nécessaire
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

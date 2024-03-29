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
        'image_real', // Ajout du champ pour l'image réelle
        'image_compressed', // Ajout du champ pour l'image compressée
        'author', // Ajout du champ author
        'username', // Ajout du champ username
        // Autres colonnes si nécessaire
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

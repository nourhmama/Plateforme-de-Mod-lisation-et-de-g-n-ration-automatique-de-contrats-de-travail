<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mot extends Model
{
    protected $table = 'mots';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mot',
        'description', // Ajout du champ description
    ];

    use HasFactory;
}

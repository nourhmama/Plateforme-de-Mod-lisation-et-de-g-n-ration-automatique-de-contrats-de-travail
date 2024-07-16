<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = ['data', 'type_contrat', 'mots_cles']; // Définir les champs remplissables

    // Si vous utilisez le champ `mots_cles` pour stocker des données JSON, vous pouvez les caster automatiquement
    protected $casts = [
        'data' => 'json', // Le champ `data` est en JSON
        'mots_cles' => 'json', // Le champ `mots_cles` est en JSON
    ];
}

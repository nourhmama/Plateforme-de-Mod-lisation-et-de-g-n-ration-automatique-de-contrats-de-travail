<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratUser extends Model
{
    use HasFactory;

    protected $table = 'contrats__users';
    protected $fillable = ['type_contrat', 'contenu_contrat', 'date_creation', 'date_fin_contrat', 'nom_employe']; // Ajout du champ nom_employe

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


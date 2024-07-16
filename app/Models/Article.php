<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['Order', 'Title', 'Description', 'contractType']; // Ajouter 'contractType' à $fillable

    public static function rules($id = null)
    {
        // Définir les règles de validation de base
        $rules = [
            'Order' => 'required|integer',
            'Title' => 'required|string',
            'Description' => 'required|string',
            'contractType' => 'required|string', // Ajouter la règle de validation pour contractType
        ];

        // Si un ID est spécifié, exclure l'unicité pour le titre et l'ordre
        if ($id !== null) {
            $rules['Title'] .= '|unique:articles,Title,' . $id; // Assurez-vous que 'T' est en majuscule dans 'Title'
            $rules['Order'] .= '|unique:articles,Order,' . $id; // Assurez-vous que 'O' est en majuscule dans 'Order'
        }

        return $rules;
    }
}

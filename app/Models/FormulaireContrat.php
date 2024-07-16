<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulaireContrat extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'formulaire_contrats';

    // Les attributs qui sont assignables en masse.
    protected $fillable = [
        'dateEmbauche',
        'poste',
        'nomEmploye',
        'dureeContrat',
        'lieuTravail',
        'adresseSiegeSocial',
        'salaire',
        'nomEntreprise',
        'regimeHebdomadaire',
        'baseHebdomadaire',
        'heureDebutHiver',
        'dureePauseDejeunerHiver',
        'heureDebutPauseDejeunerHiver',
        'heureFinPauseDejeunerHiver',
        'dureeTravailEffectifHiver',
        'heureDebutEte',
        'dureePauseEte',
        'heureDebutPauseEte',
        'heureFinPauseEte',
        'dureeTravailEffectifEte',
        'nbJoursConges',
        'villeJuridiction',
        'signature',
    ];

    // Les attributs qui devraient être convertis en types natifs.
    protected $casts = [
        'dateEmbauche' => 'datetime:Y-m-d', // Par exemple, convertit la date d'embauche en objet DateTime
    ];
}

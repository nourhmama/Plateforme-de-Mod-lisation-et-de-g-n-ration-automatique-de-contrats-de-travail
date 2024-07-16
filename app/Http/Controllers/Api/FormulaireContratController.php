<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FormulaireContrat;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FormulaireContratController extends Controller
{
    public function submitForm(Request $request)
    {
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), [
            'nomEntreprise' => 'required|string',
            'lieuTravail' => 'required|string',
            'adresseSiegeSocial' => 'required|string',
            'villeJuridiction' => 'required|string',
            'nomEmploye' => 'required|string',
            'poste' => 'required|string',
            'dateEmbauche' => 'required|date',
            'dureeContrat' => 'nullable|string',
            'salaire' => 'required|string',
            'regimeHebdomadaire' => 'required|string',
            'baseHebdomadaire' => 'required|string',
            'heureDebutHiver' => 'required|string',
            'dureePauseDejeunerHiver' => 'required|string',
            'heureDebutPauseDejeunerHiver' => 'required|string',
            'heureFinPauseDejeunerHiver' => 'required|string',
            'dureeTravailEffectifHiver' => 'required|string',
            'heureDebutEte' => 'required|string',
            'dureePauseEte' => 'required|string',
            'heureDebutPauseEte' => 'required|string',
            'heureFinPauseEte' => 'required|string',
            'dureeTravailEffectifEte' => 'required|string',
            'nbJoursConges' => 'required|string',
            'signature' => 'required|string',
        ]);

        // Vérifier si la validation a échoué
        if ($validator->fails()) {
            // Retourner les erreurs de validation au format JSON
            return response()->json([
                'success' => false,
                'message' => 'Validation des données du formulaire échouée',
                'errors' => $validator->errors()
            ], 422); // 422 correspond à l'erreur de validation
        }

        // Récupérer l'image de la signature en base64 depuis les données du formulaire
        $signatureBase64 = $request->input('signature');

        // Décoder l'URL base64 de la signature en image
        $signature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureBase64));

        // Générer un nom de fichier unique pour la signature
        $signatureFileName = uniqid() . '.png';

        // Enregistrer l'image de la signature sur le serveur
        Storage::disk('public')->put('signatures/' . $signatureFileName, $signature);

        // Enregistrer le formulaire dans la base de données avec le chemin de l'image de signature
        $formulaireContrat = new FormulaireContrat();
        $formulaireContrat->fill($request->all());
        $formulaireContrat->signature = 'signatures/' . $signatureFileName;
        $formulaireContrat->save();

        // Retourner les données enregistrées avec un message de succès au format JSON
        return response()->json([
            'success' => true,
            'message' => 'Formulaire soumis avec succès!',
            'data' => $formulaireContrat
        ]);
    }
}

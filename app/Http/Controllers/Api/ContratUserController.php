<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ContratUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;
use App\Models\User;


class ContratUserController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        
        // Vérifier si l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        // Récupérer les contrats associés à l'utilisateur authentifié
        $contrats = ContratUser::where('user_id', $user->id)->get();
        
        // Retourner les contrats associés à l'utilisateur authentifié
        return response()->json($contrats);
    }
    

    public function store(Request $request)
    {
        // Valider les données de la requête
        $validator = Validator::make($request->all(), [
            'type_contrat' => 'required|string|max:255',
            'contenu_contrat' => 'required|array',
            'date_creation' => 'required|date',
            'date_fin_contrat' => 'required|date',
            'nom_employe' => 'required|string|max:255',
        ]);
    
        // Vérifier si la validation a échoué
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
    
        // Vérifier si l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    
        // Créer une nouvelle instance de ContratUser avec les données reçues
        $contrat = new ContratUser();
        $contrat->user_id = $user->id; // Assurez-vous que votre modèle ContratUser a une relation avec le modèle User
        $contrat->type_contrat = $request->input('type_contrat');
        $contrat->nom_employe = $request->input('nom_employe');
        // Vérifiez le type de données pour le champ contenu_contrat
        $contenuContrat = $request->input('contenu_contrat');
        // Assurez-vous que le contenu du contrat est une chaîne JSON valide
        if (is_string($contenuContrat)) {
            // Si le contenu du contrat est une chaîne JSON valide, utilisez-le tel quel
            $contrat->contenu_contrat = $contenuContrat;
        } else {
            // Si le contenu du contrat n'est pas une chaîne JSON valide, convertissez-le en JSON
            $contenuContrat = json_encode($contenuContrat, JSON_UNESCAPED_UNICODE); // Ajoutez l'option JSON_UNESCAPED_UNICODE pour éviter l'encodage Unicode
            $contrat->contenu_contrat = $contenuContrat;
        }
    
        $contrat->date_creation = $request->input('date_creation');
        $contrat->date_fin_contrat = $request->input('date_fin_contrat');
    
        // Enregistrez le contrat en base de données
        $contrat->save();
    
        // Récupérez le nom de l'employé
$nomEmploye = $contrat->nom_employe;

// Vérifier si la date de fin est dans une semaine
$dateFinContrat = \Carbon\Carbon::parse($contrat->date_fin_contrat);
$dateUneSemaineAvant = now()->addWeek();
if ($dateFinContrat->lte($dateUneSemaineAvant)) {
    // Créer une notification pour cet utilisateur
    $notification = new Notification();
    $notification->user_id = $user->id;
    // Utilisez le nom de l'employé dans le message de notification
    $notification->message = "Contrat de $nomEmploye se termine dans une semaine.";
    $notification->notifiable_type = User::class;
    $notification->notifiable_id = $user->id;
    $notification->save();
}
        // Renvoyez une réponse appropriée
        return response()->json(['message' => 'Contrat enregistré avec succès', 'contrat' => $contrat], 201);
    }
    
    
    public function show($id)
    {
        // Récupérer un contrat par son ID
        $contrat = ContratUser::findOrFail($id);
        return response()->json($contrat);
    }

    public function update(Request $request, $id)
    {
        // Valider les données de la requête si nécessaire

        // Mettre à jour le contrat avec les données reçues
        $contrat = ContratUser::findOrFail($id);
        $contrat->update($request->all());

        // Retourner une réponse appropriée
        return response()->json(['message' => 'Contrat mis à jour avec succès', 'contrat' => $contrat]);
    }

    public function destroy($id)
    {
        // Supprimer un contrat par son ID
        $contrat = ContratUser::findOrFail($id);
        $contrat->delete();

        // Retourner une réponse appropriée
        return response()->json(['message' => 'Contrat supprimé avec succès']);
    }
}

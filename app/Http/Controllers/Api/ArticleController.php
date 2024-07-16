<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Valider les champs requis
            $validator = Validator::make($request->all(), [
                'Title' => 'required|string',
                'Description' => 'required|string',
                'Order' => 'required|integer',
                'contractType' => 'required|string', // Ajouter la validation pour le champ contractType
            ]);

            // Vérifier s'il y a des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // Vérifier si le titre ou l'ordre existe déjà
            $existingArticle = Article::where('Title', $request->Title)
                ->orWhere('Order', $request->Order)
                ->first();

            if ($existingArticle) {
                $errorMessage = "Le titre de l'article ou l'ordre doit être unique. Un article avec ce titre ou cet ordre existe déjà.";
                return response()->json(['error' => $errorMessage], 400);
            }

            // Créer l'article
            $article = Article::create([
                'Title' => $request->Title,
                'Description' => $request->Description,
                'Order' => $request->Order,
                'contractType' => $request->contractType,
            ]);

            return response()->json(['message' => 'Article créé avec succès', 'article' => $article], 201);
        } catch (QueryException $e) {
            // Gérer d'autres erreurs de base de données si nécessaire
            return response()->json(['error' => 'Erreur de base de données'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les champs requis
        $validator = Validator::make($request->all(), [
            'Title' => 'required|string',
            'Description' => 'required|string',
            'Order' => 'required|integer',
            'contractType' => 'required|string', // Ajouter la validation pour le champ contractType
        ]);

        // Vérifier s'il y a des erreurs de validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Trouver l'article existant
        $article = Article::findOrFail($id);

        // Mettre à jour les champs disponibles dans la requête
        $article->update([
            'Title' => $request->Title,
            'Description' => $request->Description,
            'Order' => $request->Order,
            'contractType' => $request->contractType,
        ]);

        // Retourner la réponse avec un message de succès
        return response()->json(['message' => 'Article mis à jour avec succès', 'article' => $article], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article supprimé avec succès'], 200);
    }
}

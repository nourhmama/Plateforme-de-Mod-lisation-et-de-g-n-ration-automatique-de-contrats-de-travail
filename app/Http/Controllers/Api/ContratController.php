<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrat;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = Contrat::all();

        return response()->json($contrats);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required',
            'type_contrat' => 'required',
        ]);

        $contrat = new Contrat();
        $contrat->data = $request->input('data');
        $contrat->type_contrat = $request->input('type_contrat');
        $contrat->save();

        return response()->json(['message' => 'Contrat créé avec succès'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrat = Contrat::find($id);

        if (!$contrat) {
            return response()->json(['message' => 'Contrat non trouvé'], 404);
        }

        return response()->json($contrat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required',
            'type_contrat' => 'required',
        ]);

        $contrat = Contrat::find($id);

        if (!$contrat) {
            return response()->json(['message' => 'Contrat non trouvé'], 404);
        }

        $contrat->data = $request->input('data');
        $contrat->type_contrat = $request->input('type_contrat');
        $contrat->save();

        return response()->json(['message' => 'Contrat mis à jour avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrat = Contrat::find($id);

        if (!$contrat) {
            return response()->json(['message' => 'Contrat non trouvé'], 404);
        }

        $contrat->delete();

        return response()->json(['message' => 'Contrat supprimé avec succès']);
    }
/**
 * Get contract statistics.
 *
 * @return \Illuminate\Http\Response
 */
public function statistics()
{
    // Récupérer les statistiques des contrats
    $totalContracts = Contrat::count();
    $contractsByType = Contrat::select('type_contrat', \DB::raw('count(*) as total'))
                            ->groupBy('type_contrat')
                            ->get();

    // Calculer le pourcentage pour chaque type de contrat
    foreach ($contractsByType as $contract) {
        $contract->percentage = ($contract->total / $totalContracts) * 100;
    }

    // Calculer le pourcentage total des contrats
    $percentageTotalContracts = 100; // Le total des contrats est toujours 100%

    // Formater les données des statistiques
    $statistics = [
        'total_contracts' => $totalContracts,
        'contracts_by_type' => $contractsByType,
        'percentage_total_contracts' => $percentageTotalContracts,
    ];

    // Retourner les statistiques sous forme de réponse JSON
    return response()->json($statistics);
}

}

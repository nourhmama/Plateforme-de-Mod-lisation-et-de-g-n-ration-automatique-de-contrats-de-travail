<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mot;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class MotController extends Controller
{
    public function index()
    {
        try {
            $mots = Mot::all();
            return response()->json(['mot' => $mots], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching mot: ' . $e->getMessage()], 500);
        }
    }

    public function create()
    {
        return response()->json(['message' => 'Mot creation page'], 200);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'mot' => 'required|string',
                'description' => 'nullable|string',
            ]);

            Mot::create($validatedData);

            return response()->json(['message' => 'Mot created successfully'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error creating mot: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function show(Mot $mot)
    {
        return response()->json(['mot' => $mot], 200);
    }

    public function edit(Mot $mot)
    {
        return response()->json(['message' => 'Mot edit page'], 200);
    }

    public function update(Request $request, Mot $mot)
    {
        try {
            $validatedData = $request->validate([
                'mot' => 'required|string',
                'description' => 'nullable|string',
            ]);

            $mot->update($validatedData);

            return response()->json(['message' => 'Mot updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error updating mot: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Mot $mot)
    {
        try {
            $mot->delete();
            return response()->json(['message' => 'Mot deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error deleting mot: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}

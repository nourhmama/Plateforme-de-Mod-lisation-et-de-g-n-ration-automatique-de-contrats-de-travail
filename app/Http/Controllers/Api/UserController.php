<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Lire tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    // Lire un utilisateur spécifique


    
    public function show($id)
{
    $user = User::findOrFail($id);
    return response()->json(['user' => $user]);
}

public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company' => 'required|string|max:255', // Assurez-vous de valider également la compagnie
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'required|numeric|digits_between:8,8', // Assurez-vous de valider également le numéro de téléphone
        'password' => ['required', 'confirmed'],
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'company' => $request->company, // Incluez la compagnie dans les données utilisateur
        'email' => $request->email,
        'phone_number' => $request->phone_number, // Incluez le numéro de téléphone dans les données utilisateur
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'User created', 'user' => $user]);
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Valider les données mises à jour
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company' => 'required|string|max:255', // Assurez-vous de valider également la compagnie
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'phone_number' => 'required|numeric|digits_between:8,8', // Assurez-vous de valider également le numéro de téléphone
    ]);

    // Mettre à jour l'utilisateur
    $user->update($request->all());

    return response()->json(['message' => 'User updated', 'user' => $user]);
}


    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

    public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Valider les données mises à jour
    $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'Company' => 'required|string|max:255',
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'PhoneNumber' => 'required|numeric|digits_between:8,8',
        'password' => ['nullable', 'confirmed'], // Le mot de passe est facultatif
    ]);





    // Mettre à jour les données utilisateur
    $user->update([
        'first_name' => $request->firstName,
        'last_name' => $request->lastName,
        'company' => $request->Company,
        'email' => $request->email,
        'phone_number' => $request->PhoneNumber,
    ]);

    // Mettre à jour le mot de passe s'il est fourni
    if ($request->has('password')) {
        $user->password = Hash::make($request->password);
        $user->save();
    }

    // Renvoyer uniquement les données de l'utilisateur mises à jour
    return response()->json($user);
}

public function updateUserAdmin(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Valider les données mises à jour pour un administrateur
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company' => 'required|string|max:255', // Assurez-vous de valider également la compagnie
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'phone_number' => 'required|numeric|digits_between:8,8', // Assurez-vous de valider également le numéro de téléphone
        // Ajoutez ici d'autres règles de validation spécifiques à la mise à jour de l'administrateur, le cas échéant
    ]);

    // Mettre à jour l'utilisateur avec un rôle d'administrateur
    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'company' => $request->company,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        // Ajoutez ici d'autres champs à mettre à jour, le cas échéant
    ]);

    // Mettre à jour le mot de passe s'il est fourni
    if ($request->has('password')) {
        $user->password = Hash::make($request->password);
        $user->save();
    }

    // Renvoyer uniquement les données de l'utilisateur mises à jour
    return response()->json($user);
}






}
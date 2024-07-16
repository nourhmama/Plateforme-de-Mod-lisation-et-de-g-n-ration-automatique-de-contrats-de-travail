<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountVerifiedNotification;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Débogage : Afficher les données de la demande
        Log::info('Request data:', $request->all());

        // Récupérer les données de la demande
        $requestData = $request->all();

        // Débogage : Afficher les données récupérées de la demande
        Log::info('Request data:', $requestData);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone_number' => 'required|numeric|digits_between:8,8',
                'password' => ['required', 'confirmed', Password::defaults()],
            ], [
                'phone_number.digits_between' => 'Le champ téléphone doit contenir exactement 8 chiffres.',
            ]);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'company' => $request->input('company'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'password' => Hash::make($request->input('password')),
                'role' => 'user',

            ]);

           // Vérifier si l'objet $user est null après la création
        if ($user === null) {
            throw new \Exception('Failed to create user');
        }

        // Retourner les données de l'utilisateur avec un message de succès
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user->toArray()
        ], 200);

    } catch (\Exception $e) {
        // Gérer les exceptions
        return response()->json([
            'message' => 'Erreur lors de l\'enregistrement de l\'utilisateur',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Vérifier si l'utilisateur est vérifié
        if ($user->verified !== 'Vérifié') {
            return response()->json(['message' => 'Votre compte n\'a pas été vérifié.'], 403);
        }

        // Authentifier l'utilisateur
        if (Auth::attempt($credentials)) {
            // L'utilisateur est authentifié, générer le token d'authentification
            $token = $user->createToken('authtoken')->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully',
                'data' => [
                    'user' => $user->only('id', 'email', 'role', 'first_name', 'last_name', 'company', 'phone_number'),
                    'token' => $token
                ]
            ]);
        } else {
            // Authentification échouée en raison d'un e-mail ou d'un mot de passe incorrect
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }








    public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json([
        'message' => 'Logged out'
    ]);
}


    public function adminLogin(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            $admin = Auth::user();
            $token = $admin->createToken('authToken')->plainTextToken;
            return response()->json([
                'user' => $admin, // Renvoyer les données de l'utilisateur
                'token' => $token, // Renvoyer le token
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    public function verifyUser($userId)
{
    $user = User::findOrFail($userId);
    $user->verified = 'Vérifié'; // Affecter "Vérifié" à la place de true
    $user->save();

    // Envoyer la notification à l'utilisateur
    $url = 'http://localhost:5173/auth/login'; // Remplacez par l'URL correcte de votre page de connexion
    $user->notify(new AccountVerifiedNotification($url));
    return response()->json(['message' => 'Compte vérifié avec succès'], 200);
}


}
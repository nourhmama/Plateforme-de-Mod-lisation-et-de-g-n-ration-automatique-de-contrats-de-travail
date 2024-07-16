<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class NotificationController extends Controller
{
    public function index()
    {
        // Vérifiez si l'utilisateur est authentifié
        if (Auth::check()) {
            // L'utilisateur est authentifié, récupérez les notifications non lues
            $user = Auth::user();
            $notifications = $user->notifications()->whereNull('read_at')->get();
            return response()->json(['notifications' => $notifications], 200);
        } else {
            // L'utilisateur n'est pas authentifié, retournez un message d'erreur
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
}

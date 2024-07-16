<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Middleware\VerifyAccount;
use App\Http\Controllers\Api\MotController;
use App\Http\Controllers\Api\FormulaireContratController;
use App\Http\Controllers\Api\ContratController;
use App\Http\Controllers\Api\ContratUserController;
use App\Http\Controllers\Api\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum','verified')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/admin/dashboard', function () {
  //
})->middleware(['auth', 'role:admin']);


    // Authentification User
    Route::post('login', [AuthController::class, 'login'])->middleware(VerifyAccount::class)->name('login');

    Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout']);


    Route::post('register', [AuthController::class, 'register']);


    // Vérification user compte
    Route::post('/users/{id}/verify', [AuthController::class,'verifyUser']);


    Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
  Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

    // Oublier password
    Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [NewPasswordController::class, 'reset'])->name('password.reset');
    Route::post('check-email-exists', [NewPasswordController::class, 'checkEmailExists']);

    // Routes pour les utilisateurs
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'updateUserAdmin']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    //route pour l'admin
    Route::post('admin/login', [AuthController::class, 'adminLogin']);
    Route::delete('admin/logout', [AuthController::class, 'adminLogout'])->middleware('auth:sanctum');
    // route pour update user
    Route::put('user/{id}', [UserController::class, 'updateUser']);

// Routes pour les articles
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{id}', [ArticleController::class, 'show']);
Route::post('articles', [ArticleController::class, 'store']);
Route::put('articles/{id}', [ArticleController::class, 'update']);
Route::delete('articles/{id}', [ArticleController::class, 'destroy']);
// Routes pour lesmotclé
 Route::get('mots', [MotController::class, 'index']);
 Route::get('mots/{mot}', [MotController::class, 'show']);
 Route::post('mots', [MotController::class, 'store']);
 Route::put('mots/{mot}', [MotController::class, 'update']);
 Route::delete('mots/{mot}', [MotController::class, 'destroy']);

// Route pour soumettre le formulaire de contrat
Route::post('/submit-form', [FormulaireContratController::class, 'submitForm'])->name('submit-form');
// Routes pour contrat creer par admin
Route::get('/contrats', [ContratController::class, 'index']);
Route::get('/contrats/{id}', [ContratController::class, 'show']);
Route::post('/contrats', [ContratController::class, 'store']);
Route::put('/contrats/{id}', [ContratController::class, 'update']);
Route::delete('/contrats/{id}', [ContratController::class, 'destroy']);


// Routes pour contrat creer par  user
Route::get('/contratsuser', [ContratUserController::class, 'index'])->middleware('auth:sanctum');
Route::post('/contratsuser', [ContratUserController::class, 'store'])->middleware('auth:sanctum');
Route::get('/contratsuser/{id}', [ContratUserController::class, 'show']);
Route::put('/contratsuser/{id}', [ContratUserController::class, 'update']);
Route::delete('/contratsuser/{id}', [ContratUserController::class, 'destroy']);



Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth:sanctum');


<?php

namespace A        if (Auth::attempt($credentials)) {
            // Si les identifiants sont corrects, génère un token d'accès avec toutes les permissions
            $user = Auth::user();
            $token = $user->createToken("login-token", ["*"]);

            // Retourne une réponse JSON avec le token et les données utilisateur
            return response()->json([
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthIssueTokenRequest;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): JsonResponse
    {
        // Récupère les données validées de la requête
        $credentials = $request->validated();

        // Tente d'authentifier l'utilisateur avec les identifiants fournis
        if (Auth::attempt($credentials)) {
            // Si les identifiants sont corrects, génère un token d'accès avec toutes les permissions
            $user = Auth::user();
            $token = $user->createToken("login-token", ["*"]);

            // Retourne une réponse JSON avec le token et les données utilisateur
            return response()->json([
                "user" => $user,
                "token" => [
                    "token" => $token->plainTextToken,
                    "type" => "Bearer",
                    "abilities" => ["*"] // Le token a toutes les permissions
                ]
            ]);
        }

        // Si les identifiants sont invalides, retourne une erreur 401
        return response()->json(["error" => "Invalid credentials"], 401);
    }
    {
        // Valide les identifiants via Auth::once (ne garde pas la session active)
        if (Auth::once($request->validated())) {
            // Si les identifiants sont corrects, génère un token d'accès avec toutes les permissions
            $token = Auth::user()->createToken("login-token");

            // Retourne une réponse JSON avec le token et ses métadonnées
            return response()->json([
                "token" => [
                    "token" => $token->plainTextToken,
                    "type" => "Bearer",
                    "abilities" => ["*"] // Le token a toutes les permissions
                ]
            ]);
        }

        // Si les identifiants sont invalides, retourne une erreur 401
        return response()->json(["error" => "Invalid credentials"], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        // Supprime le token utilisé pour la requête actuelle
        $request->user()->currentAccessToken()->delete();

        // Retourne une réponse vide avec le code 204 (No Content)
        return response()->json(null, 204);
    }

    public function currentUser(Request $request): JsonResponse
    {
        // Récupère l'utilisateur connecté via le token transmis
        $user = $request->user();

        // Retourne les informations de l'utilisateur
        return response()->json($user);
    }

    public function issueToken(AuthIssueTokenRequest $request): JsonResponse
    {
        // Valide les données du formulaire
        $tokenData = $request->validated();

        // Crée un nouveau token pour l'utilisateur connecté avec des permissions spécifiques
        $token = $request->user()->createToken($tokenData["name"], $tokenData["abilities"]);

        // Retourne une réponse JSON contenant les détails du token
        return response()->json([
            "token" => [
                "token" => $token->plainTextToken,
                "type" => "Bearer",
                "abilities" => $tokenData["abilities"], // Liste des permissions du token
                "name" => $tokenData["name"] // Nom du token
            ]
        ], 201);
    }

    public function register(AuthRegisterRequest $request): JsonResponse
    {
        // Create a new user with validated data
        $user = User::create([
            'first_name' => $request->validated()['firstName'],
            'last_name' => $request->validated()['lastName'],
            'email' => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password']),
        ]);

        // Generate a token for the new user
        $token = $user->createToken("registration-token");

        // Return response with token and user info
        return response()->json([
            "user" => $user,
            "token" => [
                "token" => $token->plainTextToken,
                "type" => "Bearer",
                "abilities" => ["*"]
            ]
        ], 201);
    }
}

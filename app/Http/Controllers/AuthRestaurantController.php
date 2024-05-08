<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantsUser;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthRestaurantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:restaurants', ['except' => ['loginrestaurant']]);
    }

    public function loginrestaurant(Request $request)
    {
        if (empty($request->email) || empty($request->password)) {
            return response()->json(['error' => 'Los campos email y password son obligatorios'], 422);
        }
    
        $credentials = $request->only('email', 'password');
    
        if (!Auth::guard('restaurants')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Autenticación exitosa
        $token = Auth::guard('restaurants')->attempt($credentials);
        return $this->respondWithToken($token);
    }

    public function logoutRestaurants()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
        /** @var Illuminate\Auth\AuthManager */
        $auth = auth();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $auth->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', "register"]]);
    }

    public function register(StoreUserRequest $request)
    {
        $input = $request->only(["name", "email", "password", "balance", "is_admin"]);
        $hashedPassword = bcrypt($input["password"]);
        $user = User::create([
            "name" => $input["name"],
            "email" => $input["email"],
            "password" => $hashedPassword,
            "balance" => 0,
            "is_admin" => false
        ]);

        return sendResponse("Register Success", 200, "success", [
            "name" => $user->name,
            "email" => $user->email,
            "balance" => $user->balance,
        ]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($input)) {
            return sendResponse("Unauthorized", 401, "error", null);
        }

        return sendResponse("Login Success", 200, "success", [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::user();
        return sendResponse("Authenticated", 200, "success", [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "balance" => $user->balance,
            "is_admin" => $user->is_admin
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return sendResponse('Successfully logged out', 200, "success", null);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return sendResponse("Refreshed Token", 200, "success", Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}

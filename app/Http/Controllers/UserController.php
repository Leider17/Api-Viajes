<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserReservationResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
/**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Users"},
     *     summary="Crear nuevo usuario",
     *     description="Crea un nuevo usuario",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="usuario creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function createUser(UserRequest $request): JsonResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json(
            [
                'success' => true,
                'data' => $user,
                'user' => new UserResource($user)
            ],
            201
        );
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Iniciar sesión",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="1|xyz1234abcd")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales inválidas"
     *     )
     * )
     */
    public function loginUser(LoginRequest $request)
    {
        $user = User::where('email',$request['email'])->first();
        if(!$user || !Hash::check($request['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function update($id, UserRequest $request): JsonResponse
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json(
            [
                'success' => true
            ],
            200
        );
    }

    public function logoutUser(Request $request):JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User Logged Out Successfully'
        ], Response::HTTP_OK);
    }

    public function refreshToken(Request $request):JsonResponse
    {
        $currentToken = $request->user()->currentAccessToken();

        if ($currentToken) {
            $currentToken->delete();
            $newToken = $request->user()->createToken('NewToken')->plainTextToken;

            return response()->json([
                'status' => Response::HTTP_OK,
                'token' => $newToken,
                'user' => new UserResource($request->user()),
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'error' => 'Invalid Token',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function userReservations($id):JsonResponse
    {
        $user = User::with('reservations')->findOrFail($id);

        return response()->json(new UserReservationResource($user), 200);
    }
}

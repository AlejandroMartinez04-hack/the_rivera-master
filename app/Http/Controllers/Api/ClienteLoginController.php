<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cliente;

class ClienteLoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login/cliente",
     *     summary="Iniciar sesión de cliente",
     *     description="Autentica a un cliente y devuelve un token de acceso.",
     *     tags={"Login Cliente"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"correo","contraseña","dispositivo"},
     *             @OA\Property(property="correo", type="string", example="cliente@gmail.com"),
     *             @OA\Property(property="contraseña", type="string", example="password"),
     *             @OA\Property(property="dispositivo", type="string", example="android")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="attributes", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nombre", type="string", example="Juan Pérez"),
     *                     @OA\Property(property="correo", type="string", example="cliente@gmail.com")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="1|sdf89sd8f7sd8f7s8df7")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Credenciales incorrectas"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
            'dispositivo' => 'required',
        ]);

        $cliente = Cliente::where('email', $request->correo)->first();

        if (!$cliente || ! Hash::check($request->contraseña, $cliente->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'data' => [
                'attributes' => [
                    'id' => $cliente->id,
                    'nombre' => $cliente->name,
                    'correo' => $cliente->email,
                ],
                'token' => $cliente->createToken($request->dispositivo)->plainTextToken,
            ],
        ], Response::HTTP_OK);
    }


    /**
     * @OA\Delete(
     *     path="/api/logout/cliente",
     *     summary="Cerrar sesión del cliente",
     *     description="Revoca el token actual del cliente autenticado.",
     *     tags={"Login Cliente"},
    *     security={{"bearer_token":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Cierre de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Cierre de sesión exitoso.")
     *         )
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso.',
        ], Response::HTTP_OK);
    }
}

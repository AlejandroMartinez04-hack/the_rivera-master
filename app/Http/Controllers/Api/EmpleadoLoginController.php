<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Empleado;

class EmpleadoLoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login-empleado",
     *     summary="Iniciar sesión de empleado",
     *     description="Autentica a un empleado y devuelve un token de acceso.",
     *     tags={"Login Empleado"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"correo","contraseña","dispositivo"},
     *             @OA\Property(property="correo", type="string", example="empleado@gmail.com"),
     *             @OA\Property(property="contraseña", type="string", example="password"),
     *             @OA\Property(property="dispositivo", type="string", example="windows")
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
     *                     @OA\Property(property="nombre", type="string", example="Carlos López"),
     *                     @OA\Property(property="correo", type="string", example="empleado@gmail.com")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="1|token12345")
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

        $empleado = Empleado::where('email', $request->correo)->first();

        if (!$empleado || ! Hash::check($request->contraseña, $empleado->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'data' => [
                'attributes' => [
                    'id' => $empleado->id,
                    'nombre' => $empleado->name,
                    'correo' => $empleado->email,
                ],
                'token' => $empleado->createToken($request->dispositivo)->plainTextToken,
            ],
        ], Response::HTTP_OK);
    }


    /**
     * @OA\Delete(
     *     path="/api/logout-empleado",
     *     summary="Cerrar sesión del empleado",
     *     description="Revoca el token actual del empleado autenticado.",
     *     tags={"Login Empleado"},
     *     security={{"sanctum":{}}},
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

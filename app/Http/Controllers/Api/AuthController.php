<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registro de novo usuário
     */
    public function register(Request $request)
    {
        $dadosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'termos_aceitos' => 'required|boolean|accepted',
        ]);

        $usuario = User::create([
            'name' => $dadosValidados['name'],
            'email' => $dadosValidados['email'],
            'password' => Hash::make($dadosValidados['password']),
            'termos_aceitos_em' => $dadosValidados['termos_aceitos'] ? now() : null,
            'plano' => 'gratuito',
            'biometria_ativa' => false,
        ]);

        // Gerar token Sanctum
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensagem' => 'Usuário cadastrado com sucesso',
            'usuario' => $usuario,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    /**
     * Login do usuário
     */
    public function login(Request $request)
    {
        $dadosValidados = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $usuario = User::where('email', $dadosValidados['email'])->first();

        if (!$usuario || !Hash::check($dadosValidados['password'], $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // Revoga tokens anteriores para manter sessão única por login se desejar
        $usuario->tokens()->delete();

        // Cria novo token
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensagem' => 'Login realizado com sucesso',
            'usuario' => $usuario,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /**
     * Logout (Revogar token do usuário)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'mensagem' => 'Logout realizado e token revogado com sucesso'
        ], 200);
    }
}
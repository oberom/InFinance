<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()?->id;
        $contas = Conta::where('user_id', $userId)->get();

        return response()->json($contas, 200);
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'status' => 'in:ativa,erro,expirada',
        ]);

        $dadosValidados['user_id'] = $request->user()?->id;

        $conta = Conta::create($dadosValidados);

        return response()->json($conta, 201);
    }

    public function show(string $id)
    {
        $conta = Conta::findOrFail($id);

        return response()->json($conta, 200);
    }

    public function update(Request $request, string $id)
    {
        $conta = Conta::findOrFail($id);

        $dadosValidados = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'status' => 'in:ativa,erro,expirada',
            'ultima_sincronizacao' => 'nullable|date',
        ]);

        $conta->update($dadosValidados);

        return response()->json($conta, 200);
    }

    public function destroy(string $id)
    {
        $conta = Conta::findOrFail($id);
        $conta->delete();

        return response()->json(['mensagem' => 'Conta removida com sucesso'], 200);
    }
}
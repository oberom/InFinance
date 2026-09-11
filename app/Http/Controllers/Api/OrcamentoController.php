<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        $orcamentos = Orcamento::with('categoria')
            ->where('user_id', $userId)
            ->get();

        return response()->json($orcamentos, 200);
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'valor_limite' => 'required|numeric',
            'mes' => 'required|integer|between:1,12',
            'ano' => 'required|integer',
        ]);

        $dadosValidados['user_id'] = $request->user()?->id;

        $orcamento = Orcamento::create($dadosValidados);

        return response()->json($orcamento->load('categoria'), 201);
    }

    public function show(string $id)
    {
        $orcamento = Orcamento::with('categoria')->findOrFail($id);

        return response()->json($orcamento, 200);
    }

    public function update(Request $request, string $id)
    {
        $orcamento = Orcamento::findOrFail($id);

        $dadosValidados = $request->validate([
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'valor_limite' => 'sometimes|required|numeric',
            'mes' => 'sometimes|required|integer|between:1,12',
            'ano' => 'sometimes|required|integer',
        ]);

        $orcamento->update($dadosValidados);

        return response()->json($orcamento->load('categoria'), 200);
    }

    public function destroy(string $id)
    {
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->delete();

        return response()->json(['mensagem' => 'Orçamento removido com sucesso'], 200);
    }
}
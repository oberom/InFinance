<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        $transacoes = Transacao::with(['categoria', 'conta'])
            ->where('user_id', $userId)
            ->orderBy('data', 'desc')
            ->get();

        return response()->json($transacoes, 200);
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'conta_id' => 'required|exists:contas,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'valor' => 'required|numeric',
            'tipo' => 'required|in:receita,despesa',
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
            'ignorar_orcamento' => 'boolean',
            'eh_manual' => 'boolean',
            'observacao' => 'nullable|string',
        ]);

        $dadosValidados['user_id'] = $request->user()?->id;

        $transacao = Transacao::create($dadosValidados);

        return response()->json($transacao->load(['categoria', 'conta']), 201);
    }

    public function show(string $id)
    {
        $transacao = Transacao::with(['categoria', 'conta'])->findOrFail($id);

        return response()->json($transacao, 200);
    }

    public function update(Request $request, string $id)
    {
        $transacao = Transacao::findOrFail($id);

        $dadosValidados = $request->validate([
            'conta_id' => 'sometimes|required|exists:contas,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'valor' => 'sometimes|required|numeric',
            'tipo' => 'sometimes|required|in:receita,despesa',
            'descricao' => 'sometimes|required|string|max:255',
            'data' => 'sometimes|required|date',
            'ignorar_orcamento' => 'boolean',
            'eh_manual' => 'boolean',
            'observacao' => 'nullable|string',
        ]);

        $transacao->update($dadosValidados);

        return response()->json($transacao->load(['categoria', 'conta']), 200);
    }

    public function destroy(string $id)
    {
        $transacao = Transacao::findOrFail($id);
        $transacao->delete();

        return response()->json(['mensagem' => 'Transação removida com sucesso'], 200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        $metas = Meta::with('aportes')
            ->where('user_id', $userId)
            ->get();

        return response()->json($metas, 200);
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'titulo' => 'required|string|max:255',
            'valor_objetivo' => 'required|numeric',
            'valor_atual' => 'nullable|numeric',
            'prazo' => 'required|date',
        ]);

        $dadosValidados['user_id'] = $request->user()?->id;

        $meta = Meta::create($dadosValidados);

        return response()->json($meta, 201);
    }

    public function show(string $id)
    {
        $meta = Meta::with('aportes')->findOrFail($id);

        return response()->json($meta, 200);
    }

    public function update(Request $request, string $id)
    {
        $meta = Meta::findOrFail($id);

        $dadosValidados = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'valor_objetivo' => 'sometimes|required|numeric',
            'valor_atual' => 'sometimes|required|numeric',
            'prazo' => 'sometimes|required|date',
        ]);

        $meta->update($dadosValidados);

        return response()->json($meta, 200);
    }

    public function destroy(string $id)
    {
        $meta = Meta::findOrFail($id);
        $meta->delete();

        return response()->json(['mensagem' => 'Meta removida com sucesso'], 200);
    }
}
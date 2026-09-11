<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Listar categorias (Globais/Padrão + do Usuário)
     */
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        $categorias = Categoria::whereNull('user_id')
            ->when($userId, function ($query) use ($userId) {
                return $query->orWhere('user_id', $userId);
            })
            ->where('esta_oculta', false)
            ->get();

        return response()->json($categorias, 200);
    }

    /**
     * Criar uma nova categoria personalizada
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:receita,despesa',
            'icone' => 'nullable|string|max:50',
        ];

        $dadosValidados = $request->validate($regras);
        
        $dadosValidados['user_id'] = $request->user()?->id;
        $dadosValidados['eh_personalizada'] = true;

        $categoria = Categoria::create($dadosValidados);

        return response()->json($categoria, 201);
    }

    /**
     * Exibir os detalhes de uma categoria específica
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return response()->json($categoria, 200);
    }

    /**
     * Atualizar uma categoria personalizada
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $regras = [
            'nome' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|in:receita,despesa',
            'icone' => 'nullable|string|max:50',
            'esta_oculta' => 'boolean',
        ];

        $dadosValidados = $request->validate($regras);
        $categoria->update($dadosValidados);

        return response()->json($categoria, 200);
    }

    /**
     * Remover uma categoria
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['mensagem' => 'Categoria removida com sucesso'], 200);
    }
}
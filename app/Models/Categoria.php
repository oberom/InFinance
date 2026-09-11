<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'icone',
        'tipo',
        'eh_personalizada',
        'esta_oculta',
    ];

    protected $casts = [
        'eh_personalizada' => 'boolean',
        'esta_oculta' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }
}
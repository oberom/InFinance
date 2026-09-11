<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'user_id',
        'conta_id',
        'categoria_id',
        'valor',
        'tipo',
        'descricao',
        'data',
        'ignorar_orcamento',
        'eh_manual',
        'observacao',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data' => 'date',
        'ignorar_orcamento' => 'boolean',
        'eh_manual' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function aportesMeta()
    {
        return $this->hasMany(AporteMeta::class);
    }
}
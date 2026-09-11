<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id',
        'valor_limite',
        'mes',
        'ano',
    ];

    protected $casts = [
        'valor_limite' => 'decimal:2',
        'mes' => 'integer',
        'ano' => 'integer',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
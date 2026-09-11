<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'status',
        'ultima_sincronizacao',
    ];

    protected $casts = [
        'ultima_sincronizacao' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}
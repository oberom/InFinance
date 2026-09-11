<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'valor_objetivo',
        'valor_atual',
        'prazo',
    ];

    protected $casts = [
        'valor_objetivo' => 'decimal:2',
        'valor_atual' => 'decimal:2',
        'prazo' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aportes()
    {
        return $this->hasMany(AporteMeta::class);
    }
}
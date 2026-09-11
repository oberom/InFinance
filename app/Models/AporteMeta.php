<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AporteMeta extends Model
{
    protected $table = 'aportes_metas';

    protected $fillable = [
        'meta_id',
        'transacao_id',
        'valor',
        'data',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data' => 'date',
    ];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }

    public function transacao()
    {
        return $this->belongsTo(Transacao::class);
    }
}
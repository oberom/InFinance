<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetivoUsuario extends Model
{
    protected $table = 'objetivos_usuario';

    protected $fillable = [
        'user_id',
        'tag_objetivo',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
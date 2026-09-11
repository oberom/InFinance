<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'termos_aceitos_em',
        'plano',
        'biometria_ativa',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'termos_aceitos_em' => 'datetime',
            'biometria_ativa' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function objetivos()
    {
        return $this->hasMany(ObjetivoUsuario::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function contas()
    {
        return $this->hasMany(Conta::class);
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }

    public function metas()
    {
        return $this->hasMany(Meta::class);
    }
}
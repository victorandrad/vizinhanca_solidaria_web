<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guarda extends Authenticatable
{

    use Notifiable;

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_edicao';

    protected $guard = 'guarda';

    protected $table = 'guarda';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 'email', 'senha'
    ];

    protected $hidden = [
        'senha', 'lembrar_senha'
    ];

}

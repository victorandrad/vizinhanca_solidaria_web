<?php

namespace App\Entities;

use App\Mail\RecuperaSenhaMail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Prettus\Repository\Traits\TransformableTrait;

class Usuario extends Authenticatable
{

    use Notifiable, TransformableTrait;

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_edicao';

    protected $table = 'usuario';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 'email', 'senha'
    ];

    protected $hidden = [
        'senha', 'lembrar_senha'
    ];


    protected $rememberTokenName = 'lembrar_senha';

    // Sobrescreve campo de senha de Autenticação
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function sendPasswordResetNotification($token)
    {

        Mail::send(new RecuperaSenhaMail($this->getLinkPasswordReset($this->email, $token), $this->email));

    }

    public function getLinkPasswordReset($email, $token)
    {
        return env('APP_URL') . '/password/reset/' . $token . '?email=' . $email;
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function getNameUser()
    {
        return $this->nome;
    }

}

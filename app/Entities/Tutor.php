<?php

namespace App\Entities;

use App\Mail\RecuperaSenhaMail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class Tutor extends Authenticatable
{

    use Notifiable;

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_edicao';

    protected $table = 'tutor';

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

}

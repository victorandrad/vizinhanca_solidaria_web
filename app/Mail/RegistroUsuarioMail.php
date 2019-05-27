<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $senha;
    protected $nome;

    /**
     * Create a new message instance.
     *
     * @param $nome
     * @param $email
     * @param $senha
     */
    public function __construct($nome, $email, $senha)
    {

        $this->email = $email;
        $this->senha = $senha;
        $this->nome = $nome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject('Bem-vindo ' . $this->nome . ' ao Programa Vizinhança Solidária');

        $template_email = 'email.boas_vindas';

        return $this->to($this->email)->view($template_email)->with([
            "email" => $this->email,
            "senha" => $this->senha
        ]);

    }
}

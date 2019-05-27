<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperaSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $link;
    private $email;

    /**
     * Create a new message instance.
     *
     * @param $link
     * @param $email
     */
    public function __construct($link, $email)
    {
        $this->link = $link;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject('Recuperar senha');

        $template_email = 'email.recupera_senha';

        return $this->to($this->email)->view($template_email)->with(["link" => $this->link]);

    }
}

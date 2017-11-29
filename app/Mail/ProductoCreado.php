<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductoCreado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct$nombreto, $precioto, $emailto()
    {
        $this->nombreto = $nombreto;
        $this->precioto = $precioto;
        $this->emailto = $emailto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('barbernet@osmaro.com')
                    ->subject('Nuevo producto en Barbaernet')
                    ->view('mails.servicio');
    }
}

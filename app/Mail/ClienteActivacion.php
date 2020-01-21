<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClienteActivacion extends Mailable {
    use Queueable, SerializesModels;


    public $user;
    public $config;

    public function __construct($user,$config){
        $this->user = $user;
        $this->config = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->from('info@elbunker.pe', 'El Bunker' )
                ->subject('Activación de cuenta')
                ->view('emails.activacion');
    }
}

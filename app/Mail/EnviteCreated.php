<?php

namespace App\Mail;

use App\Envite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $envite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Envite $envite)
    {
        $this->envite = $envite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.envite',['envite'=>$this->envite]);
    }
}

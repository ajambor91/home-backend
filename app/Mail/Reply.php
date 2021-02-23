<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reply extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;
    private $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(
        string $mail,
        string $name
    ) {
        $this->name = $name;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')
        ->to($this->mail)
        ->with([
            'name' => $this->name
        ]);
    }
}

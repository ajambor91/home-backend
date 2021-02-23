<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Info extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;
    private $message;
    private $name;
    private $phone;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $message, $name, $subject, $phone = null)
    {
        $this->mail = $mail;
        $this->message = $message;
        $this->name = $name;
        $this->phone = $phone;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('dev@adamjambor.pl')
                    ->replyTo($this->mail)
                    ->subject($this->subject)
                    ->view('raw')
                    ->with(['textMessage' => $this->buildMessage()]);
    }

    private function buildMessage()
    {
        return "$this->name \n
                $this->phone \n
                $this->message";
    }
}

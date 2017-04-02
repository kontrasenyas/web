<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $code;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $code, $token)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->code = $code;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('forgotpassword@libot-ph.com')
            ->view('emails.send-forgot-password');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailRegisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $mobile_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $mobile_no)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->mobile_no = $mobile_no;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@libot-ph.com', 'Libot Ph')
            ->subject('Welcome to Libot')
            ->view('emails.send-registered-user');
    }
}
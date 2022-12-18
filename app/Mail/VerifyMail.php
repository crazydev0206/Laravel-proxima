<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($new_user)
    {
        $this->data = $new_user;
    }

    public function build()
    {
        return $this->subject('Verify your email address')
            ->view('emails.verify_email')
            ->with($this->data);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailverificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.verification_email')
            ->subject('Email Verification')
            ->with([
                'user' => $this->user,
                'url' => $this->url
            ]);
    }
}

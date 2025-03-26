<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactUsMail extends Mailable
{
    public $name;
    public $lname;
    public $email;
    public $bodyMessage;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->lname = $data['lname'];
        $this->email = $data['email'];
        $this->bodyMessage = $data['bodyMessage'];
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('New Contact Us Message')
                    ->view('emails.contactUs')
                    ->with([
                        'name' => $this->name,
                        'lname' => $this->lname,
                        'email' => $this->email,
                        'bodyMessage' => $this->bodyMessage,
                    ]);
    }
}


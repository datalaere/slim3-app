<?php

namespace App\Mail;

use Anddye\Mailer\Mailable;

class WelcomeMailable extends Mailable {

    protected $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    public function build()
    {
        $this->setSubject('Welcome to the Team!');
        $this->setView('emails/welcome.twig', [
            'user' => $this->user
        ]);
        
        return $this;
    }
}

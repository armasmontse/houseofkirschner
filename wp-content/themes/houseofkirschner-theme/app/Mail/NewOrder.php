<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class NewOrder extends Mailable
{
    public $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function build()
    {
        return $this->subject('Hola mundo!')
                    ->from('example@example.com');
    }
    
}
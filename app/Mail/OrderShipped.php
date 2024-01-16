<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    
    public $OrderShipped;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($OrderShipped)
    {
        $this->OrderShipped = $OrderShipped;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.testMail');
    }
}

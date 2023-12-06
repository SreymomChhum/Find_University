<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data= [];

    public function __construct($data)
    {
        $this->data = $data;
        //
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('saisaya422@gmail.com',"Admin")
        ->subject($this->data['subject'])
        ->view('userEmail')->with('data', $this->data);
    }
}

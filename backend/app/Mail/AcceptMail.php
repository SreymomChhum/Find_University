<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
 
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
        return $this->from('saisaya422@gmail.com',"University")
        ->subject($this->data['subject'])
        ->view('acceptMail')->with('data', $this->data);
    }
}
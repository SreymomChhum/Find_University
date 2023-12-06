<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
 
    private $data= [];

    public function __construct($data)
    {
        $this->data = $data;
        //
    }
 
  
    public function build()
    {
        return $this->from('testvc041@gmail.com',"Admin")
        ->subject($this->data['subject'])
        ->view('emails.register')->with('data', $this->data);
    }
}
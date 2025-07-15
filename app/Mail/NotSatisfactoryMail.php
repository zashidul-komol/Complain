<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotSatisfactoryMail extends Mailable
{
    public $data;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //dd($data);
        $this->data=$data;
        //$subject = $this->data['complainant_name'].'Send a Message on '.$this->data['area'];
        //dd($data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject ='বিষয়: সংশোধনমূলক ব্যবস্থার অসন্তুষ্টিপত্র গ্রহণের স্বীকৃতিপত্র।';
        return $this->markdown('emails.NotSatisfactoryMail')
        ->subject($subject)
        ->with([
            'data'=> $this->data
        ])
        ;
    }
}

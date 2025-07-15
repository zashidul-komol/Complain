<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorrectiveActionLetter extends Mailable
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
        //dd($subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$subject ='Customer Complain :';
        $subject ='অভিযোগ পর্যালোচনাপূর্বক সংশোধনমূলক ব্যবস্থা গ্রহণ পত্র।';
        return $this->markdown('emails.CorrectiveActionLetter')
        ->subject($subject)
        ->with([
            'data'=> $this->data
        ])
        ;
    }
}

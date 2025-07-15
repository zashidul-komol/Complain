<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMailConsentLetter extends Mailable
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
        $subject ='সংশোধনমূলক ব্যবস্থার পুনঃতদন্তের অনুরোধ গ্রহণ ও পর্যালোচনার সম্মতিপত্র :';
        return $this->markdown('emails.customerMailConsentLetter')
        ->subject($subject)
        ->with([
            'data'=> $this->data
        ])
        ;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMail extends Mailable
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
        $subject ='প্রাথমিক অভিযোগ প্রাপ্তি স্বীকার:';
        return $this->markdown('emails.customerMail')
        ->subject($subject)
        ->with([
            'data'=> $this->data
        ])
        ;
    }
}

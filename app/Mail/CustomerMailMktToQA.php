<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMailMktToQA extends Mailable
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
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject ='অভিযোগ গ্রহণ ও পর্যালোচনার সম্মতিপত্র:';
        return $this->markdown('emails.customerMailMktToQA')
        ->subject($subject)
        ->with([
            'data'=> $this->data
        ])
        ;
    }
}

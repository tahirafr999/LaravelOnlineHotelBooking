<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// 

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $MailData;
    /**
     * Create a new message instance. 
     *
     * @return void 
     */
    public function __construct($MailData)
    {
        $this->MailData = $MailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tahirafridi0900@gmail.com')->subject('New Customer Equiry')->view('auth.verify')->with('MailData', $this->MailData);    }
}

?>
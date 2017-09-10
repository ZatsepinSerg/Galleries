<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CallMasterClass extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $userTelephon;
    protected $messageText;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$userTelephon,$messageText)
    {
        $this->name = $name;
        $this->userTelephon = $userTelephon;
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.userMail')->with([
            'name'=>$this->name,
            'userTelephon'=>$this->userTelephon,
            'messageText'=>$this->messageText
        ])->subject('Ваша заявка оформлена');
    }
}

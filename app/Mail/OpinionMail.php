<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OpinionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $messageContent;

    public function __construct($email, $messageContent)
    {
        $this->email = $email;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->view('emails.opinion') // The Blade view for the email
                    ->subject('New Opinion Submitted')
                    ->with([
                        'email' => $this->email,
                        'messageContent' => $this->messageContent,
                    ]);
    }
}

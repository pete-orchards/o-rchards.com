<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Contact;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->title = $contact->name.'様 | お問い合わせありがとうございます | Orchards';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@o-rchards.com')
        ->subject($this->title)
        ->view('emails.contact.received');
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Good;

class NotificationGood extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $good;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Good $good)
    {
        $this->user = $user;
        $this->good = $good;
        $this->title = '「いいね」されました | Orchards';
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
        ->view('emails.notification.good');
    }
}

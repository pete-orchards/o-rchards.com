<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\UserBasket;

class NotificationBasket extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $user_basket;
    public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, UserBasket $user_basket)
    {
        $this->user = $user;
        $this->user_basket = $user_basket;
        $this->title = '投稿がバスケットに追加されました | Orchards';
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
        ->view('emails.notification.basket');
    }
}

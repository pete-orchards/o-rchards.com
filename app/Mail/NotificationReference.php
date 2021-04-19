<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\PostReference;

class NotificationReference extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $post_reference;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PostReference $post_reference)
    {
        $this->user = $user;
        $this->post_reference = $post_reference;
        $this->title = '関連投稿がされました | Orchards';
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
        ->view('emails.notification.reference');
    }
}

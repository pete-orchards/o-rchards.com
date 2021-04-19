<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;
use App\User;
use App\UserBasket;
use Log;

class WebPushBasket extends Notification
{
    use Queueable;
    public $user;
    public $user_basket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, UserBasket $user_basket)
    {
        $this->user = $user;
        $this->user_basket = $user_basket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $title = 'バスケットに追加されました';
        $icon = asset($this->user_basket->user->prof_path());
        $body = $this->user_basket->user->name.'さんがあなたの投稿『'. $this->user_basket->post->each()->title.'』をバスケットに追加しました';
        $tag =  'user_basket/'.$this->user_basket->post->post_type->name.'/'.$this->user_basket->post->each()->id;
        $url = url($this->user_basket->post->post_type->name.'/'.$this->user_basket->post->each()->id);
        return (new WebPushMessage)
            ->title($title)
            ->icon($icon)
            ->body($body)
            ->tag($tag)
            ->data([
                'url' => $url,
            ]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

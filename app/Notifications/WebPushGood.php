<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;
use App\User;
use App\Good;
use Log;

class WebPushGood extends Notification
{
    use Queueable;

    public $user;
    public $good;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Good $good)
    {
        $this->user = $user;
        $this->good = $good;
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
        $title = 'グッドされました';
        $icon = asset($this->good->user->prof_path());
        $body = $this->good->user->name.'さんがあなたの投稿『'. $this->good->post->each()->title.'』をグッドしました';
        $tag =  'good/'.$this->good->post->post_type->name.'/'.$this->good->post->each()->id;
        $url = url($this->good->post->post_type->name.'/'.$this->good->post->each()->id);
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

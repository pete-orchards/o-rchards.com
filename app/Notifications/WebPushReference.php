<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;
use App\User;
use App\PostReference;
use Log;

class WebPushReference extends Notification
{
    use Queueable;
    public $user;
    public $post_reference;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, PostReference $post_reference)
    {
        $this->user = $user;
        $this->post_reference = $post_reference;
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
        $title = 'コドモ投稿されました';
        $icon = asset($this->post_reference->descendant_post->user->prof_path());
        $body = $this->post_reference->descendant_post->user->name.'さんによるコドモ投稿『'. $this->post_reference->descendant_post->each()->title.'』';
        $tag =  'post_reference/'.$this->post_reference->descendant_post->post_type->name.'/'.$this->post_reference->descendant_post->each()->id;
        $url = url($this->post_reference->descendant_post->post_type->name.'/'.$this->post_reference->descendant_post->each()->id);
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

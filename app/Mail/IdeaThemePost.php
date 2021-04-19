<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\IdeaTheme;
use App\IdeaThemeResult;
use App\IdeaThemePost as Post;

class IdeaThemePost extends Mailable
{
    use Queueable, SerializesModels;
    public $idea_theme;
    public $idea_theme_result;
    public $idea_theme_post;
    public $title;
    public $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $idea_theme_post, $text)
    {
        $this->idea_theme_post = $idea_theme_post;
        $this->idea_theme = $idea_theme_post->idea_theme;
        $this->idea_theme_result = $this->idea_theme->result;
        $this->title = 'あなたの投稿が『'.$this->idea_theme->title.'』で入賞しました！ | Orchards';
        $this->text = 'text';
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
        ->view('emails.info.idea_theme_post');
    }
}

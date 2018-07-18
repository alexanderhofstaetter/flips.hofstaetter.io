<?php

namespace App\Mail;

use App\News;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $news, $lv, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(News $news, User $user)
    {
        $this->news = $news;
        $this->lv = $news->lv;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('emails.news.updated')
                    ->subject("[Flips] Neue Ankündigung in \"" . $this->lv->name . "\" verfügbar");
    }
}

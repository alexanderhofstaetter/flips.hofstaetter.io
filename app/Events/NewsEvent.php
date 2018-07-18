<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\News;
use App\User;
use App\Mail\NewsUpdated;

class NewsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function newsCreated(News $news)
    {
        if ( $news->date >= Carbon::now()->subDays(1) ) {
            foreach ($news->lv->users()->get() as $user) {
                Mail::to( $user )->send(new NewsUpdated( $news, $user ));
            }
        }
        
    }

    public function newsUpdated(News $news)
    {   
        if ( $news->date >= Carbon::now()->subDays(1) ) {
            foreach ($news->lv->users()->get() as $user) {
                Mail::to( $user )->send(new NewsUpdated( $news, $user ));
            }
        }
    }
}

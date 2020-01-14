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

use App\News;
use App\Mail\NewsUpdated;
use Carbon\Carbon;

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
}
